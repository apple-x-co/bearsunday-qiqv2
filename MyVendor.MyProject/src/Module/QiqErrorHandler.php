<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Resource\Code;
use BEAR\Resource\Exception\BadRequestException as BadRequest;
use BEAR\Resource\Exception\ResourceNotFoundException as NotFound;
use BEAR\Sunday\Extension\Error\ErrorInterface;
use BEAR\Sunday\Extension\Transfer\TransferInterface;
use BEAR\Sunday\Extension\Router\RouterMatch as Request;
use Psr\Log\LoggerInterface;
use Throwable;

class QiqErrorHandler implements ErrorInterface
{
    public function __construct(
        private QiqErrorPage $errorPage,
        private TransferInterface $transfer,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Throwable $e, Request $request): ErrorInterface
    {
        unset($request);
        $code = $this->getCode($e);
        $eStr = (string) $e;
        $logRef = crc32($eStr);
        if ($code >= 500) {
            $this->logger->error(sprintf('logref:%s %s', $logRef, $eStr));
        }

        $this->errorPage->code = $code;
        $this->errorPage->body = [
            'status' => [
                'code' => $code,
                'message' => (new Code())->statusText[$code],
            ],
            'e' => [
                'code' => $e->getCode(),
                'class' => $e::class,
                'message' => $e->getMessage(),
            ],
            'logref' => (string) $logRef,
        ];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function transfer(): void
    {
        ($this->transfer)($this->errorPage, []);
    }

    private function getCode(Throwable $e): int
    {
        if ($e instanceof NotFound || $e instanceof BadRequest) {
            return (int) $e->getCode();
        }

        return 503;
    }
}
