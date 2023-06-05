<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Dotenv\Dotenv;
use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use DateTimeImmutable;
use DateTimeInterface;

use function dirname;

class AppModule extends AbstractAppModule
{
    protected function configure(): void
    {
        $this->bind(DateTimeInterface::class)->to(DateTimeImmutable::class); // For Di Test

        (new Dotenv())->load(dirname(__DIR__, 2));
        $this->install(new PackageModule());
    }
}
