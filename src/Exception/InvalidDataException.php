<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use CuyZ\Valinor\Mapper\MappingError;

final class InvalidDataException extends \RuntimeException implements ParserExceptionInterface
{
    public function __construct(public readonly string $json, MappingError $e)
    {
        $errors = [];
        foreach ($e->messages()->errors() as $message) {
            $errors[] = sprintf('%s: %s', $message->path(), $message->toString());
        }

        parent::__construct(sprintf(
            'You have an error in the supplied data. The error was: %s. You can access the supplied JSON in the %s property',
            implode('; ', $errors),
            self::class . '::$json',
        ), 0, $e);
    }
}
