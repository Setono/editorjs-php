<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser\Block\ListBlock;

use Setono\CodexEditor\Parser\Block\BlockInterface;

interface ListBlockInterface extends BlockInterface
{
    public function getStyle(): string;

    /**
     * @return array<array-key, string>
     */
    public function getItems(): array;
}
