<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\BlockRenderer\BlockRendererInterface;

final class UnsupportedBlockException extends \RuntimeException implements RendererExceptionInterface
{
    public function __construct(Block $block, BlockRendererInterface $blockRenderer = null)
    {
        $message = sprintf(
            'Could not render block "%s" (id: %s). No block renderer supports this block',
            $block::class,
            $block->id,
        );

        if (null !== $blockRenderer) {
            $message = sprintf(
                'The block renderer %s does not support the block %s (%s)',
                $blockRenderer::class,
                $block::class,
                $block->id,
            );
        }

        parent::__construct($message);
    }

    /**
     * @psalm-assert true $test
     */
    public static function assert(bool $test, Block $block, BlockRendererInterface $blockRenderer): void
    {
        if (!$test) {
            throw new self($block, $blockRenderer);
        }
    }
}
