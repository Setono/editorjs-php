<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\File;
use Setono\EditorJS\Block\ImageBlock;

/**
 * @covers \Setono\EditorJS\BlockRenderer\ImageBlockRenderer
 */
final class ImageBlockRendererTest extends BlockRendererTestCase
{
    protected function getBlock(): Block
    {
        return new ImageBlock(
            'WsdafMasdf',
            'image',
            new File('https://example.com/image.jpg'),
            'Cool image',
            true,
            true,
            true,
        );
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new ImageBlockRenderer();
    }

    protected function getExpectedHtml(): string
    {
        return <<<HTML
<div class="container-image with-border with-background stretched">
    <div class="image">
        <img src="https://example.com/image.jpg" alt="Cool image">
    </div>
    <div class="caption">Cool image</div>
</div>
HTML;
    }
}
