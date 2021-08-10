<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\BlockParser;

use Setono\EditorJS\Parser\Block\BlockInterface;

interface BlockParserInterface
{
    public function parse(BlockInterface $block): BlockInterface;

    public function supports(BlockInterface $block): bool;
}
