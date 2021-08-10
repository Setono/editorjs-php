<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer;

use Setono\CodexEditor\Exception\RendererException;
use Setono\CodexEditor\Parser\Result;
use Setono\CodexEditor\Renderer\BlockRenderer\BlockRendererInterface;

final class Renderer implements RendererInterface
{
    /** @var list<BlockRendererInterface> */
    private array $blockRenderers = [];

    public function render(Result $parsingResult): string
    {
        $html = '';

        foreach ($parsingResult->getBlockList() as $block) {
            foreach ($this->blockRenderers as $blockRenderer) {
                if (!$blockRenderer->supports($block)) {
                    continue;
                }

                $html .= $blockRenderer->render($block);

                continue 2;
            }

            throw new RendererException($block);
        }

        return $html;
    }

    public function addBlockRenderer(BlockRendererInterface $blockRenderer): void
    {
        $this->blockRenderers[] = $blockRenderer;
    }
}
