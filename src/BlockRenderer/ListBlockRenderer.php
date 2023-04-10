<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ListBlock;
use Setono\HtmlElement\HtmlElement;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Webmozart\Assert\Assert;

final class ListBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param ListBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        Assert::true($this->supports($block));

        return (new HtmlElement(sprintf('%sl', $block->style === ListBlock::STYLE_ORDERED ? 'o' : 'u'), ...array_map(
            fn (string $item) => HtmlElement::li($item)->withClasses($this->options['itemClasses']),
            $block->items,
        )))
            ->withClasses($this->options['classes'])
        ;
    }

    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('itemClasses', [])
            ->setAllowedTypes('itemClasses', 'array')
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
