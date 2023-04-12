<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

use Setono\EditorJS\Exception\RendererExceptionInterface;
use Setono\EditorJS\Parser\ParserResult;

interface RendererInterface
{
    /**
     * Takes a parser result as input and returns HTML as a string
     *
     * @throws RendererExceptionInterface
     */
    public function render(ParserResult $parsingResult): string;
}
