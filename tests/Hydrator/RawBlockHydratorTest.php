<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\RawBlock;

/**
 * @covers \Setono\EditorJS\Hydrator\RawBlockHydrator
 */
final class RawBlockHydratorTest extends HydratorTestCase
{
    protected function getBlock(): Block
    {
        return new RawBlock();
    }

    protected function getHydrator(): HydratorInterface
    {
        return new RawBlockHydrator();
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

    protected function assert(Block $block): void
    {
        self::assertInstanceOf(RawBlock::class, $block);
        self::assertSame('<b>yeah baby</b>', $block->html);
    }
}
