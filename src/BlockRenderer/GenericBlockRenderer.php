<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Exception\OptionsResolverException;
use Setono\EditorJS\Exception\UndefinedOptionException;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class GenericBlockRenderer implements BlockRendererInterface
{
    /** @var array<string, mixed> */
    private array $options;

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        try {
            /** @var array<string, mixed> $resolvedOptions */
            $resolvedOptions = $resolver->resolve($options);
            $this->options = $resolvedOptions;
        } catch (ExceptionInterface $e) {
            throw new OptionsResolverException($e, $this);
        }
    }

    protected function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('class', '')
            ->setAllowedTypes('class', 'string')
            ->setDefault('classPrefix', 'editorjs-')
            ->setAllowedTypes('classPrefix', 'string')
        ;
    }

    protected function hasOption(string $option): bool
    {
        return isset($this->options[$option]);
    }

    protected function getOption(string $option): mixed
    {
        if (!$this->hasOption($option)) {
            throw new UndefinedOptionException($option, array_keys($this->options));
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

        $prefix = $this->getOption('classPrefix');

        return sprintf('%s%s', is_string($prefix) ? $prefix : '', $option);
    }
}
