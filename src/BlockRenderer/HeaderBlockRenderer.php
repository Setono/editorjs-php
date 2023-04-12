<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\HeaderBlock;
use Setono\EditorJS\Exception\BlockRendererException;
use Setono\HtmlElement\HtmlElement;
use Webmozart\Assert\Assert;

final class HeaderBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param HeaderBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        BlockRendererException::assertSupportingBlock($this->supports($block), $block, $this);

        return (new HtmlElement(sprintf('h%d', $block->level), $block->text))
            ->withClass($this->getClassOption('class'))
        ;
    }

    /**
     * @psalm-assert-if-true HeaderBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof HeaderBlock;
    }
}
