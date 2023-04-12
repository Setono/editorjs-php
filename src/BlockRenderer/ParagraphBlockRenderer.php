<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ParagraphBlock;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\HtmlElement\HtmlElement;

final class ParagraphBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param ParagraphBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        UnsupportedBlockException::assert($this->supports($block), $block, $this);

        return HtmlElement::p($block->text)->withClass($this->getClassOption('class'));
    }

    /**
     * @psalm-assert-if-true ParagraphBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof ParagraphBlock;
    }
}
