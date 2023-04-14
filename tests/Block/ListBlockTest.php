<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class ListBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new ListBlock('id', ListBlock::STYLE_ORDERED, ['Item 1', 'Item 2']);
    }

    /**
     * @test
     */
    public function it_returns_tag(): void
    {
        $block = new ListBlock('id', ListBlock::STYLE_UNORDERED, ['Item 1']);
        self::assertSame('ul', $block->getTag());

        $block = new ListBlock('id', ListBlock::STYLE_ORDERED, ['Item 1']);
        self::assertSame('ol', $block->getTag());
    }
}
