<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * All blocks must inherit from this class
 */
abstract class Block
{
    public function __construct(
        /**
         * This is the unique id of the block, typically it looks something like this: GGt5HAoo0w
         */
        public readonly string $id,
        /**
         * This is the type of the block, this could be 'header', 'embed', 'delimiter' etc.
         */
        public readonly string $type,
    ) {
    }
}
