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

    /**
     * This is a helper method to get the HTML tag for the list
     */
    public function getTag(): string
    {
        return match ($this->style) {
            self::STYLE_ORDERED => 'ol',
            self::STYLE_UNORDERED => 'ul',
            default => throw new \LogicException(sprintf('The defined style "%s" is not valid', $this->style)),
        };
    }
}
