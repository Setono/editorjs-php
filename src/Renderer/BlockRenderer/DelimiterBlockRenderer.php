<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\Delimiter\DelimiterBlockInterface;
use Setono\EditorJS\Renderer\HtmlBuilder;

final class DelimiterBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof DelimiterBlockInterface);

        return (string) HtmlBuilder::create('hr')
            ->withClasses($this->options['classes'])
        ;
    }

    protected function getInterface(): string
    {
        return DelimiterBlockInterface::class;
    }
}
