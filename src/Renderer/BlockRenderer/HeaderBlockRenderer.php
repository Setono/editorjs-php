<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\Header\HeaderBlockInterface;
use Setono\EditorJS\Renderer\HtmlBuilder;

final class HeaderBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof HeaderBlockInterface);

        return (string) HtmlBuilder::create(sprintf('h%d', $block->getLevel()))
            ->withClasses($this->options['classes'])
            ->append($block->getText())
        ;
    }

    protected function getInterface(): string
    {
        return HeaderBlockInterface::class;
    }
}
