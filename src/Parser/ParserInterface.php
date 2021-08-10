<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use Setono\EditorJS\Parser\BlockParser\BlockParserInterface;

interface ParserInterface
{
    public function parse(array $data): Result;

    public function addBlockParser(BlockParserInterface $blockParser): void;
}
