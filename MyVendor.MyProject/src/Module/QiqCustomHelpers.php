<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Resource\Annotation\AppName;
use DateTimeInterface;
use Psr\Container\ContainerInterface;
use Qiq\Helper\Html\HtmlHelpers;

class QiqCustomHelpers extends HtmlHelpers
{
    public function __construct(
        #[AppName]
        private readonly string $appName,
        private readonly DateTimeInterface $dateTime,
        ContainerInterface|null $container = null,
    ) {
        parent::__construct($container);
    }

    public function appName(): string
    {
        return $this->appName;
    }

    public function currentDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }
}
