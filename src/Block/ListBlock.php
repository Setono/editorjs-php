<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class ListBlock extends Block
{
    public const STYLE_ORDERED = 'ordered';

    public const STYLE_UNORDERED = 'unordered';

    public function __construct(
        string $id,
        /**
         * @var self::STYLE_* $style
         */
        public readonly string $style,
        /**
         * @var list<string> $items
         */
        public readonly array $items,
    ) {
        parent::__construct($id);
    }
}
