<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Exception\RendererException;
use Setono\HtmlElement\HtmlElement;

final class CompositeBlockRenderer implements BlockRendererInterface
{
    /** @var list<BlockRendererInterface> */
    private array $renderers = [];

    public function add(BlockRendererInterface $blockRenderer): void
    {
        $this->renderers[] = $blockRenderer;
    }

    public function render(Block $block): HtmlElement
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
