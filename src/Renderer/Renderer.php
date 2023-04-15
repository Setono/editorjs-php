<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\BlockRenderer\BlockRendererInterface;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\EditorJS\Parser\ParserResult;

final class Renderer implements RendererInterface, LoggerAwareInterface
{
    private LoggerInterface $logger;

    /** @var list<BlockRendererInterface> */
    private array $blockRenderers = [];

    private bool $throwOnUnsupported = true;

    public function __construct()
    {
        $this->logger = new NullLogger();
    }

    public function render(ParserResult $parsingResult): string
    {
        $html = '';

        foreach ($parsingResult->blocks as $block) {
            try {
                $blockRenderer = $this->getBlockRenderer($block);

                $html .= (string) $blockRenderer->render($block);
            } catch (\Throwable $e) {
                if ($this->throwOnUnsupported) {
                    throw $e;
                }

                $this->logger->error($e->getMessage());
            }
        }

        return $html;
    }

    private function getBlockRenderer(Block $block): BlockRendererInterface
    {
        foreach ($this->blockRenderers as $blockRenderer) {
            if ($blockRenderer->supports($block)) {
                return $blockRenderer;
            }
        }

        throw new UnsupportedBlockException($block);
    }

    /**
     * Adds a block renderer to the renderer
     */
    public function add(BlockRendererInterface $blockRenderer): void
    {
        $this->blockRenderers[] = $blockRenderer;
    }

    /**
     * If true the renderer will throw any exceptions it encounters.
     * If false it will not throw the exceptions, but only log them as errors
     */
    public function throwOnUnsupported(bool $throwOnUnsupported): void
    {
        $this->throwOnUnsupported = $throwOnUnsupported;
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
