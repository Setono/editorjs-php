<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;

interface BlockRendererInterface
{
    public function render(Block $block): string;

    public function supports(Block $block): bool;
}
