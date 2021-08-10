<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Parser\Block\BlockInterface;

interface BlockRendererInterface
{
    public function render(BlockInterface $block): string;

    public function supports(BlockInterface $block): bool;
}
