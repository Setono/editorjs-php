<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use Setono\EditorJS\Exception\ParserExceptionInterface;

interface ParserInterface
{
    /**
     * @param string $json the output from the EditorJS javascript instance
     *
     * @throws ParserExceptionInterface
     */
    public function parse(string $json): ParserResult;
}
