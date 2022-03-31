<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ListBlock;
use Setono\EditorJS\Renderer\HtmlBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ListBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): string
    {
        \assert($block instanceof ListBlock);

        return (string) HtmlBuilder::create(sprintf('%sl', $block->style === ListBlock::STYLE_ORDERED ? 'o' : 'u'))
            ->withClasses($this->options['classes'])
            ->append(...array_map(
                fn (string $item) => HtmlBuilder::create('li')->withClasses($this->options['itemClasses'])->append($item),
                $block->items
            ))
        ;
    }

    /**
     * @psalm-assert array{itemClasses: array<array-key, string>} $this->options
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('itemClasses', [])
            ->setAllowedTypes('itemClasses', 'array')
        ;
    }

    protected function getBlockClass(): string
    {
        return ListBlock::class;
    }
}
