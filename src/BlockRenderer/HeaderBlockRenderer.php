<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\HeaderBlock;
use Setono\HtmlElement\HtmlElement;
use Webmozart\Assert\Assert;

final class HeaderBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): HtmlElement
    {
        Assert::true($this->supports($block));

        return (new HtmlElement(sprintf('h%d', $block->level), $block->text))
            ->withClasses($this->options['classes'])
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
