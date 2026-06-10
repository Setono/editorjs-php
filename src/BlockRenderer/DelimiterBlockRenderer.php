<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\DelimiterBlock;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\HtmlElement\HtmlElement;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class DelimiterBlockRenderer extends GenericBlockRenderer
{
    public function render(Block $block): HtmlElement
    {
        UnsupportedBlockException::assert($this->supports($block), $block, $this);

        $tag = $this->getOption('tag');

        return new HtmlElement(is_string($tag) ? $tag : 'hr')->withClass($this->getClassOption('class'));
    }

    /**
     * @phpstan-assert-if-true DelimiterBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof DelimiterBlock;
    }

    #[\Override]
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('tag', 'hr')
            ->setAllowedTypes('tag', 'string')
        ;
    }
}
