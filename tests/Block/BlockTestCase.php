<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Decoder\PhpDecoder;

abstract class BlockTestCase extends TestCase
{
    /**
     * @test
     */
    public function it_creates(): void
    {
        $blockClass = $this->getBlockClass();

        /** @var Block $block */
        $block = $blockClass::createFromArray($this->getValidData());

        self::assertInstanceOf(Block::class, $block);

        self::assertIsString($block->id);
        self::assertIsString($block->type);
        self::assertIsArray($block->data);

        $this->assertBlock($block);
    }

    /**
     * Override this method to provide your own assertions for the created block
     */
    protected function assertBlock(Block $block): void
    {
    }

    protected function getValidData(): array
    {
        return (new PhpDecoder())->decode($this->getJson());
    }

    /**
     * @return class-string<Block>
     */
    abstract protected function getBlockClass(): string;

    /**
     * Must return the JSON output for a single block
     */
    abstract protected function getJson(): string;
}
