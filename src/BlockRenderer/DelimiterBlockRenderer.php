<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\DelimiterBlock;
use Setono\EditorJS\Renderer\HtmlBuilder;

final class DelimiterBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): string
    {
        \assert($block instanceof DelimiterBlock);

        return (string) HtmlBuilder::create('hr')
            ->withClasses($this->options['classes'])
        ;
    }

    protected function getBlockClass(): string
    {
        return DelimiterBlock::class;
    }
}
