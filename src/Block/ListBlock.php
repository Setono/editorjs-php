<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class ListBlock extends Block
{
    public const STYLE_ORDERED = 'ordered';

    public const STYLE_UNORDERED = 'unordered';

    public string $style;

    /** @var list<string> */
    public array $items;

    /**
     * @return list<string>
     */
    public static function getStyles(): array
    {
        return [self::STYLE_ORDERED, self::STYLE_UNORDERED];
    }
}
