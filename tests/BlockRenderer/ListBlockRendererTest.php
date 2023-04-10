<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ListBlock;

/**
 * @covers \Setono\EditorJS\BlockRenderer\ListBlockRenderer
 */
final class ListBlockRendererTest extends BlockRendererTestCase
{
    protected function getBlock(): Block
    {
        return new ListBlock(
            'PqqMsdfbm',
            'list',
            ListBlock::STYLE_ORDERED,
            ['Item 1', 'Item 2'],
        );
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new ListBlockRenderer();
    }

    protected function getExpectedHtml(): string
    {
        return <<<HTML
<ol>
    <li>Item 1</li>
    <li>Item 2</li>
</ol>
HTML;
    }
}
