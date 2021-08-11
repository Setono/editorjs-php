<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\Parser\Block\BlockInterface;

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

    public static function invalidBlock(BlockInterface $block, string $extraMessage = null): self
    {
        $message = sprintf('Could not parse block "%s" (id: %s)', $block->getType(), $block->getId());

        if (null !== $extraMessage) {
            $message .= '. ' . $extraMessage;
        }

        return new self($message);
    }

    public static function noBlockParser(BlockInterface $block): self
    {
        $message = sprintf('No block parser for block "%s" (id: %s)', $block->getType(), $block->getId());

        return new self($message);
    }
}
