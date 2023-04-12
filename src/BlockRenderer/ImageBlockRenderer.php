<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ImageBlock;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\HtmlElement\HtmlElement;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ImageBlockRenderer extends GenericBlockRenderer
{
    /**
     * @param ImageBlock|Block $block
     */
    public function render(Block $block): HtmlElement
    {
        UnsupportedBlockException::assert($this->supports($block), $block, $this);

        $container = HtmlElement::div()
            ->withClass($this->getClassOption('containerClass'))
            ->withClass($this->getClassOption('withBorderClass'))
            ->withClass($this->getClassOption('withBackgroundClass'))
            ->withClass($this->getClassOption('stretchedClass'))
        ;

        $image = HtmlElement::img()
            ->withClass($this->getClassOption('imageClass'))
            ->withAttribute('src', $block->file->url)
        ;

        if ($block->hasCaption()) {
            $image = $image->withAttribute('alt', $block->caption);
        }

        $container = $container->append(
            HtmlElement::div($image)->withClass($this->getClassOption('imageContainerClass')),
        );

        if ($block->hasCaption()) {
            $container = $container->append(HtmlElement::div($block->caption)
                ->withClass($this->getClassOption('captionContainerClass')))
            ;
        }

        return $container;
    }

    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('containerClass', 'container-image')
            ->setAllowedTypes('containerClass', 'string')
            ->setDefault('imageContainerClass', 'image')
            ->setAllowedTypes('imageContainerClass', 'string')
            ->setDefault('captionContainerClass', 'caption')
            ->setAllowedTypes('captionContainerClass', 'string')
            ->setDefault('imageClass', '')
            ->setAllowedTypes('imageClass', 'string')
            ->setDefault('withBorderClass', 'with-border')
            ->setAllowedTypes('withBorderClass', 'string')
            ->setDefault('withBackgroundClass', 'with-background')
            ->setAllowedTypes('withBackgroundClass', 'string')
            ->setDefault('stretchedClass', 'stretched')
            ->setAllowedTypes('stretchedClass', 'string')
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
