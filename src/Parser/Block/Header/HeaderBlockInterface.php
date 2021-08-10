<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Header;

use Setono\EditorJS\Parser\Block\BlockInterface;

interface HeaderBlockInterface extends BlockInterface
{
    public function getText(): string;

    public function getLevel(): int;
}
