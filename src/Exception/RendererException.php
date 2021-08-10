<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Exception;

use Setono\CodexEditor\Parser\Block\BlockInterface;

final class RendererException extends \RuntimeException implements ExceptionInterface
{
    public function __construct(BlockInterface $block)
    {
        $message = sprintf('Could not render block "%s" (id: %s).', $block->getType(), $block->getId());

        parent::__construct($message);
    }
}
