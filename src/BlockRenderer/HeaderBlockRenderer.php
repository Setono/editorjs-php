<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\HeaderBlock;
use Setono\EditorJS\Renderer\HtmlBuilder;

final class HeaderBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): string
    {
        \assert($block instanceof HeaderBlock);

        return (string) HtmlBuilder::create(sprintf('h%d', $block->level))
            ->withClasses($this->options['classes'])
            ->append($block->text)
        ;
    }

    protected function getBlockClass(): string
    {
        return HeaderBlock::class;
    }
}
