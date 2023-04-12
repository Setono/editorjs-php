<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\DelimiterBlock;

final class DelimiterBlockRendererTest extends BlockRendererTestCase
{
    protected function getData(): iterable
    {
        yield [
            new DelimiterBlock('PqqMsdfbm'),
            '<hr>',
        ];

        yield [
            new DelimiterBlock('PqqMsdfbm'),
            '<div class="editorjs-delimiter"></div>',
            new DelimiterBlockRenderer([
                'tag' => 'div',
                'class' => 'delimiter',
            ]),
        ];
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new DelimiterBlockRenderer();
    }
}
