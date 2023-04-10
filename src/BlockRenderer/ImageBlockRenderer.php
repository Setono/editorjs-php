<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ImageBlock;
use Setono\HtmlElement\HtmlElement;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Webmozart\Assert\Assert;

final class ImageBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param ImageBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        Assert::true($this->supports($block));

        return HtmlElement::div(
            HtmlElement::div(
                HtmlElement::img()
                    ->withClasses($this->options['imageClasses'])
                    ->withAttribute('src', $block->file->url)
                    ->withAttribute('alt', $block->caption),
            )->withClasses($this->options['imageContainerClasses']),
            HtmlElement::div($block->caption)
                ->withClasses($this->options['captionContainerClasses']),
        )->withClasses($this->options['baseContainerClasses'])
            ->withClasses($this->options['withBorderClasses'])
            ->withClasses($this->options['withBackgroundClasses'])
            ->withClasses($this->options['stretchedClasses'])
        ;
    }

    /**
     * @psalm-assert array{baseContainerClasses: list<string>, imageContainerClasses: list<string>, captionContainerClasses: list<string>} $this->options
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

    /**
     * @psalm-assert-if-true ImageBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof ImageBlock;
    }
}
