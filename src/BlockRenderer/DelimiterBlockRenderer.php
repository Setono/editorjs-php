<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\DelimiterBlock;
use Setono\HtmlElement\HtmlElement;
use Webmozart\Assert\Assert;

final class DelimiterBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): HtmlElement
    {
        Assert::true($this->supports($block));

        return HtmlElement::hr()->withClasses($this->options['classes']);
    }

    /**
     * @psalm-assert-if-true DelimiterBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof DelimiterBlock;
    }
}
