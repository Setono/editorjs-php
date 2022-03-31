<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use Setono\EditorJS\Exception\ParserException;

interface ParserInterface
{
    /**
     * @param string $json the output from the EditorJS javascript instance
     *
     * @throws ParserException
     */
    public function parse(string $json): ParserResult;
}
