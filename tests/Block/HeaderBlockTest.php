<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * @covers \Setono\EditorJS\Block\HeaderBlock
 */
final class HeaderBlockTest extends BlockTestCase
{
    protected function assertBlock(Block $block): void
    {
        self::assertInstanceOf(HeaderBlock::class, $block);
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

    protected function getBlockClass(): string
    {
        return HeaderBlock::class;
    }
}
