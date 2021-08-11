<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

use Setono\EditorJS\Exception\RendererException;
use Setono\EditorJS\Parser\Result;
use Setono\EditorJS\Renderer\BlockRenderer\BlockRendererInterface;

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

            throw RendererException::unsupportedBlock($block);
        }

        return $html;
    }

    public function addBlockRenderer(BlockRendererInterface $blockRenderer): void
    {
        $this->blockRenderers[] = $blockRenderer;
    }
}
