<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\EmbedBlock;
use Setono\HtmlElement\HtmlElement;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Webmozart\Assert\Assert;

final class EmbedBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): HtmlElement
    {
        Assert::true($this->supports($block));

        return HtmlElement::div(
            HtmlElement::iframe()
                ->withAttribute('width', $block->width)
                ->withAttribute('height', $block->height)
                ->withAttribute('src', $block->embed)
                ->withAttribute('frameborder', 0)
                ->withAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture')
                ->withAttribute('allowfullscreen')
                ->withClasses($this->options['classes']),
        )->withClasses($this->options['containerClasses']);
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

    /**
     * @psalm-assert-if-true EmbedBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof EmbedBlock;
    }
}
