<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer\BlockRenderer;

use Setono\CodexEditor\Parser\Block\BlockInterface;
use Setono\CodexEditor\Parser\Block\ListBlock\ListBlockInterface;

final class ListBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof ListBlockInterface);

        $html = sprintf('<%sl>', $block->getStyle() === 'ordered' ? 'o' : 'u');
        foreach ($block->getItems() as $item) {
            $html .= sprintf('<li>%s</li>', $item);
        }
        $html .= sprintf('</%sl>', $block->getStyle() === 'ordered' ? 'o' : 'u');

        return $html;
    }

    protected function getInterface(): string
    {
        return ListBlockInterface::class;
    }
}
