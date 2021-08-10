<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer\BlockRenderer;

use Setono\CodexEditor\Parser\Block\BlockInterface;
use Setono\CodexEditor\Parser\Block\Paragraph\ParagraphBlockInterface;

final class ParagraphBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof ParagraphBlockInterface);

        return sprintf('<p>%s</p>', $block->getText());
    }

    protected function getInterface(): string
    {
        return ParagraphBlockInterface::class;
    }
}
