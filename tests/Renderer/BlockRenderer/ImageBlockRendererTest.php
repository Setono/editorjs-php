<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\ImageBlock;

/**
 * @covers \Setono\EditorJS\Renderer\BlockRenderer\ImageBlockRenderer
 */
final class ImageBlockRendererTest extends TestCase
{
    /**
     * @test
     */
    public function it_renders(): void
    {
        $block = new ImageBlock();
        $block->id = 'WsdafMasdf';
        $block->type = 'image';
        $block->url = 'https://example.com/image.jpg';
        $block->caption = 'Cool image';
        $block->withBackground = true;
        $block->withBorder = true;
        $block->stretched = true;

        $blockRenderer = new ImageBlockRenderer();
        $html = $blockRenderer->render($block);

        self::assertSame('<div class="container-image with-border with-background stretched"><div class="image"><img src="https://example.com/image.jpg" alt="Cool image"></div><div class="caption">Cool image</div></div>', $html);
    }
}
