<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Delimiter;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\GenericBlock;

final class DelimiterBlock extends GenericBlock implements DelimiterBlockInterface
{
    public static function createFromBlock(BlockInterface $block): self
    {
        return new self(
            $block->getId(),
            $block->getType(),
            $block->getData()
        );
    }
}
