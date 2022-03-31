<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

use Setono\EditorJS\Exception\RendererException;
use Setono\EditorJS\Parser\ParserResult;

interface RendererInterface
{
    /**
     * Takes a parser result as input and returns HTML as a string
     *
     * @throws RendererException if any block is unsupported
     */
    public function render(ParserResult $parsingResult): string;
}
