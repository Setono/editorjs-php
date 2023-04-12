<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\ListBlock;

final class ListBlockRendererTest extends BlockRendererTestCase
{
    protected function getData(): iterable
    {
        yield [
            new ListBlock(
                'PqqMsdfbm',
                ListBlock::STYLE_ORDERED,
                ['Item 1', 'Item 2'],
            ),
            <<<HTML
<ol>
    <li>Item 1</li>
    <li>Item 2</li>
</ol>
HTML
        ];
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new ListBlockRenderer();
    }
}
