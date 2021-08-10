<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

use Setono\EditorJS\Parser\Result;
use Setono\EditorJS\Renderer\BlockRenderer\BlockRendererInterface;

interface RendererInterface
{
    /**
     * Takes a parsing result as input and returns HTML as a string
     */
    public function render(Result $parsingResult): string;

    public function addBlockRenderer(BlockRendererInterface $blockRenderer): void;
}
