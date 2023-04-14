<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class HeaderBlock extends Block
{
    public function __construct(
        string $id,
        public readonly string $text,
        /**
         * This is the header level, i.e. 1 for h1, 2 for h2, etc.
         */
        public readonly int $level,
    ) {
        parent::__construct($id);
    }

    /**
     * This is a helper method to get the HTML tag for the header
     */
    public function getTag(): string
    {
        return sprintf('h%d', $this->level);
    }
}
