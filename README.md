# bearsunday-qiqv2

## Basic usage

```php
$this->install(new QiqModule([$this->appMeta->appDir . '/var/qiq/template']));
```

※ [see](MyVendor.MyProject/src/Module/HtmlModule.php#L15)

## Using custom helper

`QiqCustomHelpers` is can using Ray.Di's Di !!

```php
$this->bind(Helpers::class)->to(QiqCustomHelpers::class);
```

```php
<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use Psr\Container\ContainerInterface;
use Qiq\Helper\Html\HtmlHelpers;

class QiqCustomHelpers extends HtmlHelpers
{
    public function __construct(
        ContainerInterface $container = null,
    ) {
        parent::__construct($container);
    }

    public function yourHelperName(): string
    {
        return 'ReturnValue';
    }
}
```
