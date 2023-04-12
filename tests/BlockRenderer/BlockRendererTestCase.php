<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\Block;

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

        $blockRenderer = $blockRenderer ?? $this->getBlockRenderer();

        self::assertSame($html, $blockRenderer->render($block)->render());
    }

    /**
     * @return iterable<array-key, array{0: Block, 1: string, 2?: BlockRendererInterface}>
     */
    abstract protected function getData(): iterable;

    abstract protected function getBlockRenderer(): BlockRendererInterface;
}
