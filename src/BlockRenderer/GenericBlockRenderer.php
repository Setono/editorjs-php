<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

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

    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('classes', [])
            ->setAllowedTypes('classes', 'array')
        ;
    }
}
