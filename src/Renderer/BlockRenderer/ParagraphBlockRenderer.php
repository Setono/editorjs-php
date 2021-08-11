<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\Paragraph\ParagraphBlockInterface;
use Setono\EditorJS\Renderer\HtmlBuilder;

final class ParagraphBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof ParagraphBlockInterface);

        return (string) HtmlBuilder::create('p')
            ->withClasses($this->options['classes'])
            ->append($block->getText())
        ;
    }

    protected function getInterface(): string
    {
        return ParagraphBlockInterface::class;
    }
}
