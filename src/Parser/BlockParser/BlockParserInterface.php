<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser\BlockParser;

use Setono\CodexEditor\Parser\Block\BlockInterface;

interface BlockParserInterface
{
    public function parse(BlockInterface $block): BlockInterface;

    public function supports(BlockInterface $block): bool;
}
