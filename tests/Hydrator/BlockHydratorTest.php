<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use Setono\EditorJS\Block\Block;

/**
 * @covers \Setono\EditorJS\Hydrator\BlockHydrator
 */
final class BlockHydratorTest extends HydratorTestCase
{
    protected function getBlock(): Block
    {
        return new Block();
    }

    protected function getHydrator(): HydratorInterface
    {
        return new BlockHydrator();
    }

    protected function getData(): array
    {
        return [
            'id' => 'test-id',
            'type' => 'paragraph',
            'data' => [
                'text' => 'test',
            ],
        ];
    }

    protected function assert(Block $block): void
    {
        self::assertSame('test-id', $block->id);
        self::assertSame('paragraph', $block->type);
        self::assertSame(['text' => 'test'], $block->data);
    }
}
