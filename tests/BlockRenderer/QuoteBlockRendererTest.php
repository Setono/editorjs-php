<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\QuoteBlock;

final class QuoteBlockRendererTest extends BlockRendererTestCase
{
    protected function getData(): iterable
    {
        yield [
            new QuoteBlock('KmfRaA', 'We are the champions', 'Queen', 'left'),
            '<blockquote>We are the champions<cite>Queen</cite></blockquote>',
        ];
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new QuoteBlockRenderer();
    }
}
