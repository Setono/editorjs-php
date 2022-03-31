<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * @covers \Setono\EditorJS\Block\ImageBlock
 */
final class ImageBlockTest extends BlockTestCase
{
    protected function assertBlock(Block $block): void
    {
        self::assertInstanceOf(ImageBlock::class, $block);

        self::assertSame('https://nordjyskemuseer.dk/wp-content/uploads/2021/04/4-Koebmaendenes-Aalborg-1.jpg', $block->url);
        self::assertSame('Aalborg', $block->caption);
        self::assertFalse($block->withBorder);
        self::assertFalse($block->withBackground);
        self::assertFalse($block->stretched);
    }

    protected function getJson(): string
    {
        return <<<JSON
{
  "id": "ce70FrWRuj",
  "type": "image",
  "data": {
    "file": {
      "url": "https://nordjyskemuseer.dk/wp-content/uploads/2021/04/4-Koebmaendenes-Aalborg-1.jpg"
    },
    "caption": "Aalborg",
    "withBorder": false,
    "stretched": false,
    "withBackground": false
  }
}
JSON;
    }

    protected function getBlockClass(): string
    {
        return ImageBlock::class;
    }
}
