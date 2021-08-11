<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\ListBlock\ListBlockInterface;
use Setono\EditorJS\Renderer\HtmlBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ListBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof ListBlockInterface);

        return (string) HtmlBuilder::create(sprintf('%sl', $block->getStyle() === ListBlockInterface::STYLE_ORDERED ? 'o' : 'u'))
            ->withClasses($this->options['classes'])
            ->append(...array_map(
                fn (string $item) => HtmlBuilder::create('li')->withClasses($this->options['itemClasses'])->append($item),
                $block->getItems()
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

    protected function getInterface(): string
    {
        return ListBlockInterface::class;
    }
}
