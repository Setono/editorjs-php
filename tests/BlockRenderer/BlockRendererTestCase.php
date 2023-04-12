<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Exception\UnsupportedBlockException;

abstract class BlockRendererTestCase extends TestCase
{
    /**
     * @test
     *
     * @dataProvider getData
     */
    public function it_renders(Block $block, string $html, BlockRendererInterface $blockRenderer = null): void
    {
        // this could be done much more beautiful, but it works :D
        $html = str_replace("\n", ' ', $html);
        $html = preg_replace('/[ ]+/', ' ', $html);
        $html = str_replace('> <', '><', $html);

        $blockRenderer ??= $this->getBlockRenderer();

        self::assertSame($html, $blockRenderer->render($block)->render());
    }

    /**
     * @test
     */
    public function it_throws_exception_if_block_is_not_supported(): void
    {
        $this->expectException(UnsupportedBlockException::class);
        $this->getBlockRenderer()->render(new UnsupportedBlock('id'));
    }

    /**
     * @return iterable<array-key, array{0: Block, 1: string, 2?: BlockRendererInterface}>
     */
    abstract protected function getData(): iterable;

    abstract protected function getBlockRenderer(): BlockRendererInterface;
}

final class UnsupportedBlock extends Block
{
}
