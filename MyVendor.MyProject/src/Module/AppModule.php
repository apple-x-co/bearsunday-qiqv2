<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Dotenv\Dotenv;
use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use DateTimeImmutable;
use DateTimeInterface;
use Qiq\Helpers;

use function dirname;

class AppModule extends AbstractAppModule
{
    protected function configure(): void
    {
        $this->bind(DateTimeInterface::class)->to(DateTimeImmutable::class); // For Di Test

        $this->bind()->annotatedWith('qiq_extension')->toInstance('.php');
        $this->bind()->annotatedWith('qiq_paths')->toInstance([]);
        $this->bind(Helpers::class)->to(Helpers::class);

        (new Dotenv())->load(dirname(__DIR__, 2));
        $this->install(new PackageModule());
    }
}
