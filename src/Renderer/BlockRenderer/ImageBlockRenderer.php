<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ImageBlock;
use Setono\EditorJS\Renderer\HtmlBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ImageBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): string
    {
        \assert($block instanceof ImageBlock);

        return (string) HtmlBuilder::create('div')
            ->withClasses($this->options['baseContainerClasses'])
            ->withClasses($this->options['withBorderClasses'])
            ->withClasses($this->options['withBackgroundClasses'])
            ->withClasses($this->options['stretchedClasses'])
            ->append(
                HtmlBuilder::create('div')
                ->withClasses($this->options['imageContainerClasses'])
                ->append(
                    HtmlBuilder::create('img')
                    ->withClasses($this->options['imageClasses'])
                    ->withAttribute('src', $block->url)
                    ->withAttribute('alt', $block->caption)
                )
            )
            ->append(
                HtmlBuilder::create('div')
                ->withClasses($this->options['captionContainerClasses'])
                ->append($block->caption)
            )
        ;
    }

    /**
     * @psalm-assert array{baseContainerClasses: array<array-key, string>, imageContainerClasses: array<array-key, string>, captionContainerClasses: array<array-key, string>} $this->options
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('baseContainerClasses', ['container-image'])
            ->setAllowedTypes('baseContainerClasses', 'array')
            ->setDefault('imageContainerClasses', ['image'])
            ->setAllowedTypes('imageContainerClasses', 'array')
            ->setDefault('captionContainerClasses', ['caption'])
            ->setAllowedTypes('captionContainerClasses', 'array')
            ->setDefault('imageClasses', [])
            ->setAllowedTypes('imageClasses', 'array')
            ->setDefault('withBorderClasses', ['with-border'])
            ->setAllowedTypes('withBorderClasses', 'array')
            ->setDefault('withBackgroundClasses', ['with-background'])
            ->setAllowedTypes('withBackgroundClasses', 'array')
            ->setDefault('stretchedClasses', ['stretched'])
            ->setAllowedTypes('stretchedClasses', 'array')
        ;
    }

    protected function getBlockClass(): string
    {
        return ImageBlock::class;
    }
}
