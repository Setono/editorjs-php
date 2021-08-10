<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\ListBlock;

use Setono\EditorJS\Parser\Block\BlockInterface;

interface ListBlockInterface extends BlockInterface
{
    public function getStyle(): string;

    /**
     * @return array<array-key, string>
     */
    public function getItems(): array;
}
