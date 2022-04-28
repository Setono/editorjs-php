<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Setono\EditorJS\BlockRenderer\BlockRendererInterface;
use Setono\EditorJS\Exception\RendererException;
use Setono\EditorJS\Parser\ParserResult;

final class Renderer implements RendererInterface, LoggerAwareInterface
{
    private BlockRendererInterface $blockRenderer;

    private bool $throwOnUnsupported;

    private LoggerInterface $logger;

    public function __construct(BlockRendererInterface $blockRenderer, bool $throwOnUnsupported = true)
    {
        $this->blockRenderer = $blockRenderer;
        $this->throwOnUnsupported = $throwOnUnsupported;
        $this->logger = new NullLogger();
    }

    public function render(ParserResult $parsingResult): string
    {
        $html = '';

        foreach ($parsingResult->blocks as $block) {
            if (!$this->blockRenderer->supports($block)) {
                if ($this->throwOnUnsupported) {
                    throw RendererException::unsupportedBlock($block);
                }

                $this->logger->error(sprintf('Could not render block "%s" (id: %s). No block renderer supports this block', $block->type, $block->id));

                continue;
            }

            $html .= $this->blockRenderer->render($block);
        }

        return $html;
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
