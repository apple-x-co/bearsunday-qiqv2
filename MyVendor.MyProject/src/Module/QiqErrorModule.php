<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Resource\RenderInterface;
use BEAR\Sunday\Extension\Error\ErrorInterface;
use Ray\Di\AbstractModule;

class QiqErrorModule extends AbstractModule
{
    public function __construct(
        private readonly string $errorViewName = 'Error',
        ?AbstractModule $module = null
    ) {
        parent::__construct($module);
    }

    protected function configure(): void
    {
        $this->bind()->annotatedWith('qiq_error_view_name')->toInstance($this->errorViewName);
        $this->bind(RenderInterface::class)->annotatedWith('error_page')->to(QiqErrorPageRenderer::class);
        $this->bind(ErrorInterface::class)->to(QiqErrorHandler::class);
        $this->bind(QiqErrorPage::class);
    }
}
