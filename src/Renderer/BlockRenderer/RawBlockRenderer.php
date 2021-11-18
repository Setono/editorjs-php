<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\Raw\RawBlockInterface;
use Setono\EditorJS\Renderer\HtmlBuilder;

final class RawBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof RawBlockInterface);

        return (string) HtmlBuilder::create('div')
            ->withClasses($this->options['classes'])
            ->append($block->getHtml())
        ;
    }

    protected function getInterface(): string
    {
        return RawBlockInterface::class;
    }
}
