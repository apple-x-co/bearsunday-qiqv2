<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Package\AbstractAppModule;

class HtmlModule extends AbstractAppModule
{
    protected function configure(): void
    {
        $this->install(new QiqModule(
            $this->appMeta->appDir . '/var/qiq/template',
            [$this->appMeta->appDir . '/var/qiq/template'],
        ));
    }
}
