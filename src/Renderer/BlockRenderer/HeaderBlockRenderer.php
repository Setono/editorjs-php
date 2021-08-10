<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer\BlockRenderer;

use Setono\CodexEditor\Parser\Block\BlockInterface;
use Setono\CodexEditor\Parser\Block\Header\HeaderBlockInterface;

final class HeaderBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof HeaderBlockInterface);

        return sprintf('<h%d>%s</h%d>', $block->getLevel(), $block->getText(), $block->getLevel());
    }

    protected function getInterface(): string
    {
        return HeaderBlockInterface::class;
    }
}
