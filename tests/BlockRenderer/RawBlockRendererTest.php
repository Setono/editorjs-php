<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\RawBlock;

final class RawBlockRendererTest extends BlockRendererTestCase
{
    protected function getData(): iterable
    {
        yield [
            new RawBlock('PqqMsdfbm', '<img src="https://example.com/image.jpg" alt="Beautiful image">'),
            '<div><img src="https://example.com/image.jpg" alt="Beautiful image"></div>',
        ];
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new RawBlockRenderer();
    }
}
