<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\RawBlock;
use Setono\HtmlElement\HtmlElement;
use Webmozart\Assert\Assert;

final class RawBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): HtmlElement
    {
        Assert::true($this->supports($block));

        return HtmlElement::div($block->html)->withClasses($this->options['classes']);
    }

    /**
     * @psalm-assert-if-true RawBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof RawBlock;
    }
}
