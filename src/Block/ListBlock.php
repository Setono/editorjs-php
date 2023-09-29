<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class ListBlock extends Block
{
    public const STYLE_ORDERED = 'ordered';

    public const STYLE_UNORDERED = 'unordered';

    /**
     * This is a helper property containing the html tag for the list (i.e. ol/ul)
     *
     * @var 'ol'|'ul'
     */
    public string $tag;

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

        $this->tag = $style === self::STYLE_ORDERED ? 'ol' : 'ul';
    }

    /**
     * This is a helper method to get the HTML tag for the list
     *
     * @deprecated Use the public $tag property instead
     */
    public function getTag(): string
    {
        return $this->tag;
    }
}
