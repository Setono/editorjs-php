<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ListBlock;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\HtmlElement\HtmlElement;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ListBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param ListBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        UnsupportedBlockException::assert($this->supports($block), $block, $this);

        return (new HtmlElement($block->tag, ...array_map(
            fn (string $item) => HtmlElement::li($item)->withClass($this->getClassOption('itemClass')),
            $block->items,
        )))
            ->withClass($this->getClassOption('class'))
        ;
    }

    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('itemClass', '')
            ->setAllowedTypes('itemClass', 'string')
        ;
    }

    /**
     * @psalm-assert-if-true ListBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof ListBlock;
    }
}
