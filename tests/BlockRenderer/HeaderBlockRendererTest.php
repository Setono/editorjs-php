<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\HeaderBlock;

final class HeaderBlockRendererTest extends BlockRendererTestCase
{
    protected function getData(): iterable
    {
        yield [
            new HeaderBlock('PqqMsdfbm', 'Header', 1),
            '<h1>Header</h1>',
        ];
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new HeaderBlockRenderer();
    }
}
