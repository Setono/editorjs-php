<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer\BlockRenderer;

use Setono\CodexEditor\Parser\Block\BlockInterface;

interface BlockRendererInterface
{
    public function render(BlockInterface $block): string;

    public function supports(BlockInterface $block): bool;
}
