<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

use PHPUnit\Framework\TestCase;

abstract class BlockTestCase extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_sets_the_id(): void
    {
        self::assertSame('id', $this->getBlock()->id);
    }

    abstract protected function getBlock(): Block;
}
