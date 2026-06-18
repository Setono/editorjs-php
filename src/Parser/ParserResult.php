<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use Setono\EditorJS\Block\Block;

final class ParserResult
{
    public function __construct(
        public readonly \DateTimeImmutable $time,
        public readonly string $version,
        /** @var list<Block> $blocks */
        public readonly array $blocks,
    ) {
    }
}
