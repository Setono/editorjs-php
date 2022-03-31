<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ParagraphBlock;
use Setono\EditorJS\Renderer\HtmlBuilder;

final class ParagraphBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): string
    {
        \assert($block instanceof ParagraphBlock);

        return (string) HtmlBuilder::create('p')
            ->withClasses($this->options['classes'])
            ->append($block->text)
        ;
    }

    protected function getBlockClass(): string
    {
        return ParagraphBlock::class;
    }
}
