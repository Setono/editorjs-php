<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer\BlockRenderer;

use Setono\CodexEditor\Parser\Block\BlockInterface;
use Setono\CodexEditor\Parser\Block\Delimiter\DelimiterBlockInterface;

final class DelimiterBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof DelimiterBlockInterface);

        return '<hr>';
    }

    protected function getInterface(): string
    {
        return DelimiterBlockInterface::class;
    }
}
