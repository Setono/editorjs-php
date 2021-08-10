<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser\Block\Header;

use Setono\CodexEditor\Parser\Block\BlockInterface;

interface HeaderBlockInterface extends BlockInterface
{
    public function getText(): string;

    public function getLevel(): int;
}
