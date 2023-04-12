<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\EmbedBlock;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\HtmlElement\HtmlElement;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class EmbedBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param EmbedBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        UnsupportedBlockException::assert($this->supports($block), $block, $this);

        return HtmlElement::div(
            HtmlElement::iframe()
                ->withAttribute('width', $block->width)
                ->withAttribute('height', $block->height)
                ->withAttribute('src', $block->embed)
                ->withAttribute('frameborder', 0)
                ->withAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture')
                ->withAttribute('allowfullscreen')
                ->withClass($this->getClassOption('class')),
        )->withClass($this->getClassOption('containerClass'));
    }

    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('containerClass', 'container-embed')
            ->setAllowedTypes('containerClass', 'string')
        ;
    }

    /**
     * @psalm-assert-if-true EmbedBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof EmbedBlock;
    }
}
