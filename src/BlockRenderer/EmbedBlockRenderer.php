<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\EmbedBlock;
use Setono\EditorJS\HtmlBuilder\HtmlBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class EmbedBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): string
    {
        \assert($block instanceof EmbedBlock);

        return HtmlBuilder::create('div')
            ->withClasses($this->options['containerClasses'])
            ->append(
                HtmlBuilder::create('iframe')
                    ->withAttribute('width', $block->width)
                    ->withAttribute('height', $block->height)
                    ->withAttribute('src', $block->embed)
                    ->withAttribute('frameborder', 0)
                    ->withAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture')
                    ->withAttribute('allowfullscreen')
                    ->withClasses($this->options['classes'])
            )->build();
    }

    /**
     * @psalm-assert array{containerClasses: list<string>} $this->options
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('containerClasses', ['container-embed'])
            ->setAllowedTypes('containerClasses', 'array')
        ;
    }

    protected function getBlockClass(): string
    {
        return EmbedBlock::class;
    }
}
