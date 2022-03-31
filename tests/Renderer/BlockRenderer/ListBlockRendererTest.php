<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\ListBlock;

/**
 * @covers \Setono\EditorJS\BlockRenderer\ListBlockRenderer
 */
final class ListBlockRendererTest extends TestCase
{
    /**
     * @test
     */
    public function it_renders(): void
    {
        $block = new ListBlock();
        $block->id = 'PqqMsdfbm';
        $block->type = 'list';
        $block->style = ListBlock::STYLE_ORDERED;
        $block->items = ['Item 1', 'Item 2'];

        $blockRenderer = new ListBlockRenderer();
        $html = $blockRenderer->render($block);

        self::assertSame('<ol><li>Item 1</li><li>Item 2</li></ol>', $html);
    }
}
