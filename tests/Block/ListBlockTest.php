<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * @covers \Setono\EditorJS\Block\ListBlock
 */
final class ListBlockTest extends BlockTestCase
{
    protected function assertBlock(Block $block): void
    {
        self::assertInstanceOf(ListBlock::class, $block);
    }

    protected function getJson(): string
    {
        return <<<JSON
{
  "id": "MSOMhc8uPn",
  "type": "list",
  "data": {
    "style": "ordered",
    "items": [
      "test",
      "test"
    ]
  }
}
JSON;
    }

    protected function getBlockClass(): string
    {
        return ListBlock::class;
    }
}
