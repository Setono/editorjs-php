<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

final class Result
{
    private \DateTimeInterface $time;

    private string $version;

    private BlockList $blockList;

    public function __construct(\DateTimeInterface $time, string $version, BlockList $blockList)
    {
        $this->time = $time;
        $this->version = $version;
        $this->blockList = $blockList;
    }

    public function getTime(): \DateTimeInterface
    {
        return $this->time;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getBlockList(): BlockList
    {
        return $this->blockList;
    }
}
