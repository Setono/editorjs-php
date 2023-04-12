<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\RawBlock;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\HtmlElement\HtmlElement;

final class RawBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param RawBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        UnsupportedBlockException::assert($this->supports($block), $block, $this);

        return HtmlElement::div($block->html)->withClass($this->getClassOption('class'));
    }

    /**
     * @psalm-assert-if-true RawBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof RawBlock;
    }
}
