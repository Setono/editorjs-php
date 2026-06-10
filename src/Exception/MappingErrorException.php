<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use CuyZ\Valinor\Mapper\MappingError;
use Setono\EditorJS\Block\Block;

final class MappingErrorException extends \InvalidArgumentException implements ParserExceptionInterface
{
    /**
     * @param class-string<Block> $mapping
     */
    public function __construct(MappingError $e, string $type, string $mapping)
    {
        $errorMessage = $e->getMessage() . "\n\n";

        foreach ($e->messages()->errors() as $message) {
            $errorMessage .= sprintf("%s: %s\n", $message->path(), $message->toString());
        }

        parent::__construct(sprintf(
            'The block type "%s" could not be mapped to the class "%s". The error was: %s',
            $type,
            $mapping,
            $errorMessage,
        ), 0, $e);
    }
}
