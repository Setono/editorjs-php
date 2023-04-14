<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class HeaderBlockTest extends BlockTestCase
{
    protected function getBlock(): HeaderBlock
    {
        return new HeaderBlock('id', 'Header', 1);
    }

    /**
     * @test
     */
    public function it_returns_tag(): void
    {
        self::assertSame('h1', $this->getBlock()->getTag());
    }
}
