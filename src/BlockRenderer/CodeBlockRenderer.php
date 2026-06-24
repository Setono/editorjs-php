<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\CodeBlock;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\HtmlElement\HtmlElement;

final class CodeBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param CodeBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        UnsupportedBlockException::assert($this->supports($block), $block, $this);

        return new HtmlElement('code', $block->code);
    }

    /**
     * @psalm-assert-if-true CodeBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof CodeBlock;
    }
}
