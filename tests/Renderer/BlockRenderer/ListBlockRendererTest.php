<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Parser\Block\ListBlock\ListBlock;

/**
 * @covers \Setono\EditorJS\Renderer\BlockRenderer\ListBlockRenderer
 */
final class ListBlockRendererTest extends TestCase
{
    /**
     * @test
     */
    public function it_renders(): void
    {
        $block = new ListBlock('asdf', 'list', 'ordered', ['Item 1', 'Item 2'], []);

        $blockRenderer = new ListBlockRenderer();
        $html = $blockRenderer->render($block);

        self::assertSame('<ol><li>Item 1</li><li>Item 2</li></ol>', $html);
    }
}
