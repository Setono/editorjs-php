<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Image\File;
use Setono\EditorJS\Block\ImageBlock;

final class ImageBlockRendererTest extends BlockRendererTestCase
{
    protected function getData(): iterable
    {
        yield [
            new ImageBlock(
                'WsdafMasdf',
                new File('https://example.com/image.jpg'),
                'Cool image',
                true,
                true,
                true,
            ),
            <<<HTML
<div class="editorjs-container-image editorjs-with-border editorjs-with-background editorjs-stretched">
    <div class="editorjs-image">
        <img src="https://example.com/image.jpg" alt="Cool image">
    </div>
    <div class="editorjs-caption">Cool image</div>
</div>
HTML
        ];

        yield [
            new ImageBlock(
                'WsdafMasdf',
                new File('https://example.com/image.jpg'),
                '',
                true,
                true,
                true,
            ),
            <<<HTML
<div class="editorjs-container-image editorjs-with-border editorjs-with-background editorjs-stretched">
    <div class="editorjs-image">
        <img src="https://example.com/image.jpg">
    </div>
</div>
HTML
        ];
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new ImageBlockRenderer();
    }
}
