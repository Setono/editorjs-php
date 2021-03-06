<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Setono\EditorJS\Block\Block;

/**
 * @covers \Setono\EditorJS\BlockHydrator\BlockHydrator
 */
final class BlockHydratorTest extends HydratorTestCase
{
    protected function getBlock(): Block
    {
        return new Block();
    }

    protected function getHydrator(): BlockHydratorInterface
    {
        return new BlockHydrator();
    }

    protected function getJson(): string
    {
        return <<<JSON
{
  "id": "tePlWkvizR",
  "type": "paragraph",
  "data": {
    "text": "test"
  }
}
JSON;
    }

    protected function assert(Block $block): void
    {
        self::assertSame('tePlWkvizR', $block->id);
        self::assertSame('paragraph', $block->type);
        self::assertSame(['text' => 'test'], $block->data);
    }
}
