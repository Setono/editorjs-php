<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\QuoteBlock;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\HtmlElement\HtmlElement;

final class QuoteBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param QuoteBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        UnsupportedBlockException::assert($this->supports($block), $block, $this);

        $element = HtmlElement::blockquote($block->text)
            ->withClass($this->getClassOption('class'))
        ;

        if ('' !== $block->caption) {
            return $element->append(HtmlElement::cite($block->caption));
        }

        return $element;
    }

    /**
     * @psalm-assert-if-true QuoteBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof QuoteBlock;
    }
}
