<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser;

use Setono\CodexEditor\Parser\BlockParser\BlockParserInterface;

interface ParserInterface
{
    public function parse(array $data): Result;

    public function addBlockParser(BlockParserInterface $blockParser): void;
}
