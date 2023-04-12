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

        return (new HtmlElement($this->getOption('tag')))->withClass($this->getClassOption('class'));
    }

    /**
     * @psalm-assert-if-true DelimiterBlock $block
     */
    public function supports(Block $block): bool
    {
        return $block instanceof DelimiterBlock;
    }

    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefault('tag', 'hr')
            ->setAllowedTypes('tag', 'string')
        ;
    }
}
