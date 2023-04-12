<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class ListBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new ListBlock('id', ListBlock::STYLE_ORDERED, ['Item 1', 'Item 2']);
    }
}
