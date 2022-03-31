<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ParagraphBlock;

/**
 * @covers \Setono\EditorJS\Hydrator\ParagraphBlockHydrator
 */
final class ParagraphBlockHydratorTest extends HydratorTestCase
{
    protected function getBlock(): Block
    {
        return new ParagraphBlock();
    }

    protected function getHydrator(): HydratorInterface
    {
        return new ParagraphBlockHydrator();
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
        self::assertInstanceOf(ParagraphBlock::class, $block);
        self::assertSame('test', $block->text);
    }
}
