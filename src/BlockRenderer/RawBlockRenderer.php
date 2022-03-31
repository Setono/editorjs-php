<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\RawBlock;
use Setono\EditorJS\HtmlBuilder\HtmlBuilder;

final class RawBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): string
    {
        \assert($block instanceof RawBlock);

        return (string) HtmlBuilder::create('div')
            ->withClasses($this->options['classes'])
            ->append($block->html)
        ;
    }

    protected function getBlockClass(): string
    {
        return RawBlock::class;
    }
}
