<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer;

use Setono\CodexEditor\Parser\Result;
use Setono\CodexEditor\Renderer\BlockRenderer\BlockRendererInterface;

interface RendererInterface
{
    /**
     * Takes a parsing result as input and returns HTML as a string
     */
    public function render(Result $parsingResult): string;

    public function addBlockRenderer(BlockRendererInterface $blockRenderer): void;
}
