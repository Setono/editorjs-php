<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class QuoteBlock extends Block
{
    public function __construct(
        string $id,
        public readonly string $text,
        public readonly string $caption,
        /**
         * @var 'left'|'center'
         */
        public readonly string $alignment,
    ) {
        parent::__construct($id);
    }
}
