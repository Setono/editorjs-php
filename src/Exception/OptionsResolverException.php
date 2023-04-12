<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\BlockRenderer\BlockRendererInterface;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;

/**
 * @internal
 */
final class OptionsResolverException extends \InvalidArgumentException implements RendererExceptionInterface
{
    public function __construct(ExceptionInterface $e, BlockRendererInterface $blockRenderer)
    {
        parent::__construct(sprintf(
            'An exception occurred when trying to resolve the options for the block renderer %s: %s',
            $blockRenderer::class,
            $e->getMessage(),
        ), 0, $e);
    }
}
