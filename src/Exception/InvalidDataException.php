<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Psl\Type\Exception\AssertException;

final class InvalidDataException extends \RuntimeException implements ParserExceptionInterface
{
    public function __construct(public readonly string $json, AssertException $e)
    {
        parent::__construct(sprintf(
            'You have an error in the supplied data. The error was: %s. You can access the supplied JSON in the %s property',
            $e->getMessage(),
            self::class . '::$json',
        ), 0, $e);
    }
}
