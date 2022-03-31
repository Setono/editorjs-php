<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * @covers \Setono\EditorJS\Block\EmbedBlock
 */
final class EmbedBlockTest extends BlockTestCase
{
    protected function assertBlock(Block $block): void
    {
        self::assertInstanceOf(EmbedBlock::class, $block);
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

    protected function getBlockClass(): string
    {
        return EmbedBlock::class;
    }
}
