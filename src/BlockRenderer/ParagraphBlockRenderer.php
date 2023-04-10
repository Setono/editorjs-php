<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ParagraphBlock;
use Setono\HtmlElement\HtmlElement;
use Webmozart\Assert\Assert;

final class ParagraphBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): HtmlElement
    {
        Assert::true($this->supports($block));

        return HtmlElement::p($block->text)->withClasses($this->options['classes']);
    }

    /**
     * @psalm-assert-if-true ParagraphBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof ParagraphBlock;
    }
}
