<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\HeaderBlock;

/**
 * @covers \Setono\EditorJS\BlockHydrator\HeaderBlockHydrator
 */
final class HeaderBlockHydratorTest extends HydratorTestCase
{
    protected function getBlock(): Block
    {
        return new HeaderBlock();
    }

    protected function getHydrator(): BlockHydratorInterface
    {
        return new HeaderBlockHydrator();
    }

    protected function getJson(): string
    {
        return <<<JSON
{
  "id": "GQqw0WbDdk",
  "type": "header",
  "data": {
    "text": "test",
    "level": 2
  }
}
JSON;
    }

    protected function assert(Block $block): void
    {
        self::assertInstanceOf(HeaderBlock::class, $block);
        self::assertSame('test', $block->text);
        self::assertSame(2, $block->level);
    }
}
