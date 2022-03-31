<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\EmbedBlock;

/**
 * @covers \Setono\EditorJS\BlockRenderer\EmbedBlockRenderer
 */
final class EmbedBlockRendererTest extends BlockRendererTestCase
{
    protected function getBlock(): Block
    {
        // <iframe width="560" height="315" src="https://www.youtube.com/embed/HHI3w8gXB-Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        $block = new EmbedBlock();
        $block->id = 'PqqMsdfbm';
        $block->type = 'embed';
        $block->width = 560;
        $block->height = 315;
        $block->embed = 'https://www.youtube.com/embed/HHI3w8gXB-Y';

        return $block;
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new EmbedBlockRenderer();
    }

    protected function getExpectedHtml(): string
    {
        return <<<HTML
<div class="container-embed">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/HHI3w8gXB-Y" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    </iframe>
</div>
HTML;
    }
}
