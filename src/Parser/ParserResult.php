<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use Setono\EditorJS\Block\Block;

final class ParserResult
{
    public \DateTimeInterface $time;

    public string $version;

    /** @var list<Block> */
    public array $blocks;

    /**
     * @param list<Block> $blocks
     */
    public function __construct(\DateTimeInterface $time, string $version, array $blocks)
    {
        $this->time = $time;
        $this->version = $version;
        $this->blocks = $blocks;
    }
}
