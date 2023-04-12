<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Exception\BlockRendererException;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class GenericBlockRenderer implements BlockRendererInterface
{
    private array $options;

    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('class', '')
            ->setAllowedTypes('class', 'string')
            ->setDefault('classPrefix', 'editorjs-')
            ->setAllowedTypes('classPrefix', 'string')
        ;
    }

    /**
     * @psalm-assert-if-true mixed $this->options[$option]
     */
    protected function hasOption(string $option): bool
    {
        return isset($this->options[$option]);
    }

    protected function getOption(string $option): mixed
    {
        if (!$this->hasOption($option)) {
            throw BlockRendererException::undefinedOption($option, array_keys($this->options));
        }

        return $this->options[$option];
    }

    /**
     * This is a helper method to allow you to get an option value which MUST be a (css) class option.
     * This method will then prepend the class prefix to the option and return it
     */
    protected function getClassOption(string $option): string
    {
        /** @var mixed $option */
        $option = $this->getOption($option);
        if (!is_string($option) || '' === $option) {
            return '';
        }

        /** @psalm-suppress MixedArgument */
        return sprintf('%s%s', $this->getOption('classPrefix'), $option);
    }
}
