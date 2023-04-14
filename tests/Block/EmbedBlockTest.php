<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class EmbedBlockTest extends BlockTestCase
{
    protected function getBlock(): EmbedBlock
    {
        return new EmbedBlock('id', 'youtube', 'https://youtube.com/sadfas', 'https://youtube.com/embed/sadfas', 200, 150);
    }

    /**
     * @test
     */
    public function it_returns_aspect_ratio(): void
    {
        self::assertSame('200 / 150', $this->getBlock()->getAspectRatio());
    }
}
