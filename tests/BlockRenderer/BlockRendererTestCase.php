<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\Block;

abstract class BlockRendererTestCase extends TestCase
{
    /**
     * @test
     */
    public function it_renders(): void
    {
        // this could be done much more beautiful, but it works :D
        $expectedHtml = str_replace("\n", ' ', $this->getExpectedHtml());
        $expectedHtml = preg_replace('/[ ]+/', ' ', $expectedHtml);
        $expectedHtml = str_replace('> <', '><', $expectedHtml);

        self::assertSame($expectedHtml, $this->getBlockRenderer()->render($this->getBlock()));
    }

    abstract protected function getBlock(): Block;

    abstract protected function getBlockRenderer(): BlockRendererInterface;

    abstract protected function getExpectedHtml(): string;
}
