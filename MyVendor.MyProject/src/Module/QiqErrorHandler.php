<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Resource\Code;
use BEAR\Resource\Exception\BadRequestException as BadRequest;
use BEAR\Resource\Exception\ResourceNotFoundException as NotFound;
use BEAR\Sunday\Extension\Error\ErrorInterface;
use BEAR\Sunday\Extension\Router\RouterMatch as Request;
use BEAR\Sunday\Extension\Transfer\TransferInterface;
use Psr\Log\LoggerInterface;
use Throwable;

use function crc32;
use function sprintf;

class QiqErrorHandler implements ErrorInterface
{
    public function __construct(
        private QiqErrorPage $errorPage,
        private TransferInterface $transfer,
        private LoggerInterface $logger,
    ) {
    }

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

    public function transfer(): void
    {
        ($this->transfer)($this->errorPage, []);
    }

    private function getCode(Throwable $e): int
    {
        if ($e instanceof NotFound) {
            return $e->getCode();
        }

        if ($e instanceof BadRequest) {
            return $e->getCode();
        }

        return 503;
    }
}
