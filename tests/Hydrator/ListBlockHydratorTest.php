<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ListBlock;

/**
 * @covers \Setono\EditorJS\Hydrator\ListBlockHydrator
 */
final class ListBlockHydratorTest extends HydratorTestCase
{
    protected function getBlock(): Block
    {
        return new ListBlock();
    }

    protected function getHydrator(): HydratorInterface
    {
        return new ListBlockHydrator();
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
      "test1",
      "test2"
    ]
  }
}
JSON;
    }

    protected function assert(Block $block): void
    {
        self::assertInstanceOf(ListBlock::class, $block);
        self::assertSame('ordered', $block->style);
        self::assertSame(['test1', 'test2'], $block->items);
    }
}
