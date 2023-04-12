<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\EmbedBlock;

final class EmbedBlockRendererTest extends BlockRendererTestCase
{
    protected function getData(): iterable
    {
        yield [
            new EmbedBlock(
                'PqqMsdfbm',
                'youtube',
                'https://www.youtube.com/watch?v=HHI3w8gXB-Y',
                'https://www.youtube.com/embed/HHI3w8gXB-Y',
                560,
                315,
            ),
            <<<HTML
<div class="editorjs-container-embed">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/HHI3w8gXB-Y" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    </iframe>
</div>
HTML
        ];
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new EmbedBlockRenderer();
    }
}
