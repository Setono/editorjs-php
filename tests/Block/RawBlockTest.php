<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * @covers \Setono\EditorJS\Block\RawBlock
 */
final class RawBlockTest extends BlockTestCase
{
    protected function assertBlock(Block $block): void
    {
        self::assertInstanceOf(RawBlock::class, $block);
    }

    protected function getJson(): string
    {
        return <<<JSON
{
  "id": "1SufC48zCX",
  "type": "raw",
  "data": {
    "html": "<b>yeah baby</b>"
  }
}
JSON;
    }

    protected function getBlockClass(): string
    {
        return RawBlock::class;
    }
}
