<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\Page;

use BEAR\Resource\ResourceObject;

class Unexpected extends ResourceObject
{
    public function onGet(): static
    {
        return $this;
    }
}
