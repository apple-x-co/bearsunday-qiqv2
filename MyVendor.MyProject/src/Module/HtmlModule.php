<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Package\AbstractAppModule;
use Qiq\Helpers;

class HtmlModule extends AbstractAppModule
{
    protected function configure(): void
    {
        $this->bind(Helpers::class)->to(QiqCustomHelpers::class);
        $this->install(new QiqModule([$this->appMeta->appDir . '/var/qiq/template']));
        $this->install(new QiqErrorModule());
    }
}
