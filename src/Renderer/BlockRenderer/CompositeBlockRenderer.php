<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Exception\RendererException;

final class CompositeBlockRenderer implements BlockRendererInterface
{
    /** @var list<BlockRendererInterface> */
    private array $renderers = [];

    public function add(BlockRendererInterface $blockRenderer): void
    {
        $this->renderers[] = $blockRenderer;
    }

    public function render(Block $block): string
    {
        foreach ($this->renderers as $renderer) {
            if ($renderer->supports($block)) {
                return $renderer->render($block);
            }
        }

        throw RendererException::unsupportedBlock($block);
    }

    public function supports(Block $block): bool
    {
        foreach ($this->renderers as $renderer) {
            if ($renderer->supports($block)) {
                return true;
            }
        }

        return false;
    }
}
