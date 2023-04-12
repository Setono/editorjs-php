<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

/**
 * @internal
 */
final class InvalidJsonException extends \InvalidArgumentException implements ParserExceptionInterface
{
    public function __construct(public readonly string $json, \JsonException $e)
    {
        parent::__construct(sprintf(
            'You have an error in your JSON. The error was: %s. You can access the supplied JSON in the %s property',
            $e->getMessage(),
            self::class . '::$json',
        ), 0, $e);
    }
}
