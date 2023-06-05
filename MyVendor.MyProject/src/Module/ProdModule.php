<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Package\AbstractAppModule;
use BEAR\Package\Context\ProdModule as PackageProdModule;

class ProdModule extends AbstractAppModule
{
    protected function configure(): void
    {
        $this->install(new QiqErrorModule());
        $this->install(new QiqProdModule($this->appMeta->appDir . '/var/tmp'));

        $this->install(new PackageProdModule());
    }
}
