<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

final class ParserException extends \RuntimeException implements ExceptionInterface
{
    public static function invalidJson(string $jsonError): self
    {
        return new self($jsonError);
    }

    public static function invalidData(string $error): self
    {
        return new self($error);
    }

    /**
     * @param mixed $block
     */
    public static function invalidType($block): self
    {
        $message = 'Could not parse block';

        if (is_string($block)) {
            $message = sprintf('Could not parse block. Input was %s', $block);
        }

        return new self($message);
    }

    public static function unmappedBlockType(string $type): self
    {
        return new self(sprintf('The block type "%s" not mapped to any block. Did you forget to add the type to block mapping for this particular type?', $type));
    }

    public static function unsupportedBlockType(string $type): self
    {
        return new self(sprintf('The block type "%s" is not supported by any hydrator. Did you forget to add a hydrator for this particular type?', $type));
    }
}
