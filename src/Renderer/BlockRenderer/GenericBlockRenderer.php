<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class GenericBlockRenderer implements BlockRendererInterface
{
    protected array $options;

    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    public function supports(BlockInterface $block): bool
    {
        return is_a($block, $this->getInterface(), true);
    }

    /**
     * @psalm-assert array{classes: array<array-key, string>} $this->options
     */
    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('classes', [])
            ->setAllowedTypes('classes', 'array')
        ;
    }

    /**
     * @return class-string
     */
    abstract protected function getInterface(): string;
}
