<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

/**
 * @internal
 */
final class UndefinedOptionException extends \RuntimeException implements RendererExceptionInterface
{
    /**
     * @param list<scalar> $definedOptions
     */
    public function __construct(string $option, array $definedOptions)
    {
        parent::__construct(sprintf(
            'The option "%s" is not defined. Defined options are: [%s]',
            $option,
            implode(', ', $definedOptions),
        ));
    }
}
