<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ImageBlock;

/**
 * @covers \Setono\EditorJS\Hydrator\ImageBlockHydrator
 */
final class ImageBlockHydratorTest extends HydratorTestCase
{
    protected function getBlock(): Block
    {
        return new ImageBlock();
    }

    protected function getHydrator(): HydratorInterface
    {
        return new ImageBlockHydrator();
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

    protected function assert(Block $block): void
    {
        self::assertInstanceOf(ImageBlock::class, $block);
        self::assertSame('https://nordjyskemuseer.dk/wp-content/uploads/2021/04/4-Koebmaendenes-Aalborg-1.jpg', $block->url);
        self::assertSame('Aalborg', $block->caption);
        self::assertFalse($block->withBackground);
        self::assertFalse($block->withBorder);
        self::assertFalse($block->stretched);
    }
}
