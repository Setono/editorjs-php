<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\Block\Block;

final class RendererException extends \RuntimeException implements ExceptionInterface
{
    public static function unsupportedBlock(Block $block): self
    {
        $message = sprintf('Could not render block "%s" (id: %s). No block renderer supports this block', $block->type, $block->id);

        return new self($message);
    }
}
