<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\Block\Block;

/**
 * @internal
 */
final class RendererException extends \RuntimeException implements ExceptionInterface
{
    public static function unsupportedBlock(Block $block): self
    {
        return new self(sprintf(
            'Could not render block "%s" (id: %s). No block renderer supports this block',
            $block::class,
            $block->id,
        ));
    }

    public static function fromThrowable(\Throwable $e): self
    {
        if ($e instanceof self) {
            return $e;
        }

        return new self($e->getMessage(), 0, $e);
    }
}
