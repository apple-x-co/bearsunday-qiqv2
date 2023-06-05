<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class QiqErrorPage extends ResourceObject
{
    /** @var array<string, string>  */
    public $headers = ['content-type' => 'text/html; charset=utf-8'];

    /** @var RenderInterface|null */
    protected $renderer;

    /** @return list<string> */
    public function __sleep(): array
    {
        return ['renderer'];
    }

    #[Inject, Named('error_page')]
    public function setRenderer(RenderInterface $renderer): ResourceObject
    {
        return parent::setRenderer($renderer);
    }
}
