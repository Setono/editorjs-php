<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use Setono\EditorJS\Block\Block;

final readonly class ParserResult
{
    public function __construct(
        public \DateTimeImmutable $time,
        public string $version,
        /** @var list<Block> $blocks */
        public array $blocks,
    ) {
    }
}
