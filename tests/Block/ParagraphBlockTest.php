<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * @covers \Setono\EditorJS\Block\ParagraphBlock
 */
final class ParagraphBlockTest extends BlockTestCase
{
    protected function assertBlock(Block $block): void
    {
        self::assertInstanceOf(ParagraphBlock::class, $block);
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

    protected function getBlockClass(): string
    {
        return ParagraphBlock::class;
    }
}
