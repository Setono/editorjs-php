<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\EmbedBlock;

/**
 * @covers \Setono\EditorJS\BlockHydrator\EmbedBlockHydrator
 */
final class EmbedBlockHydratorTest extends HydratorTestCase
{
    protected function getBlock(): Block
    {
        return new EmbedBlock();
    }

    protected function getHydrator(): BlockHydratorInterface
    {
        return new EmbedBlockHydrator();
    }

    protected function getJson(): string
    {
        return <<<JSON
{
  "id": "H9jC7ruSp-",
  "type": "embed",
  "data": {
    "service": "youtube",
    "source": "https://www.youtube.com/watch?v=MxexAd0k44U",
    "embed": "https://www.youtube.com/embed/MxexAd0k44U",
    "width": 580,
    "height": 320,
    "caption": ""
  }
}
JSON;
    }

    protected function assert(Block $block): void
    {
        self::assertInstanceOf(EmbedBlock::class, $block);
        self::assertSame('youtube', $block->service);
        self::assertSame('https://www.youtube.com/watch?v=MxexAd0k44U', $block->source);
        self::assertSame('https://www.youtube.com/embed/MxexAd0k44U', $block->embed);
        self::assertSame(580, $block->width);
        self::assertSame(320, $block->height);
        self::assertSame('', $block->caption);
    }
}
