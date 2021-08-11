<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Parser\Block\Image\File;
use Setono\EditorJS\Parser\Block\Image\ImageBlock;

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
        $block = new ImageBlock('asdf', 'image', new File('https://example.com/image.jpg'), 'Cool image', true, true, true, []);

        $blockRenderer = new ImageBlockRenderer();
        $html = $blockRenderer->render($block);

        self::assertSame('<div class="container-image with-border with-background stretched"><div class="image"><img src="https://example.com/image.jpg" alt="Cool image"></div><div class="caption">Cool image</div></div>', $html);
    }
}
