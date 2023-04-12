<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\BlockRenderer\BlockRendererInterface;

/**
 * @internal
 */
final class BlockRendererException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @param list<scalar> $definedOptions
     */
    public static function undefinedOption(string $option, array $definedOptions): self
    {
        return new self(sprintf(
            'The option "%s" is not defined. Defined options are: [%s]',
            $option,
            implode(', ', $definedOptions),
        ));
    }

    /**
     * @psalm-assert true $test
     */
    public static function assertSupportingBlock(bool $test, Block $block, BlockRendererInterface $blockRenderer): void
    {
        if (!$test) {
            throw new self(sprintf(
                'The block renderer %s does not support the block %s',
                $blockRenderer::class,
                $block::class,
            ));
        }
    }
}
