<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\Parser\Parser;

final class UnmappedTypeException extends \RuntimeException implements ParserExceptionInterface
{
    public function __construct(string $type)
    {
        parent::__construct(sprintf(
            'The block type "%s" was not mapped to any class. Did you forget to add the type to the mapping for this particular type? You can use %s',
            $type,
            Parser::class . '::setMapping()',
        ));
    }
}
