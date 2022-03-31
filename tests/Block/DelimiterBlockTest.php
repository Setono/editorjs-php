<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * @covers \Setono\EditorJS\Block\DelimiterBlock
 */
final class DelimiterBlockTest extends BlockTestCase
{
    protected function assertBlock(Block $block): void
    {
        self::assertInstanceOf(DelimiterBlock::class, $block);
    }

    protected function getJson(): string
    {
        return <<<JSON
{
      "id": "T12wkl5S37",
      "type": "delimiter",
      "data": {}
    }
JSON;
    }

    protected function getBlockClass(): string
    {
        return DelimiterBlock::class;
    }
}
