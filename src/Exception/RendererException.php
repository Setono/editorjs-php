<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\Parser\Block\BlockInterface;

final class RendererException extends \RuntimeException implements ExceptionInterface
{
    public static function unsupportedBlock(BlockInterface $block): self
    {
        $message = sprintf('Could not render block "%s" (id: %s). No block renderer supports this block', $block->getType(), $block->getId());

        return new self($message);
    }
}
