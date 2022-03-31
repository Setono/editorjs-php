<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\Block;

abstract class HydratorTestCase extends TestCase
{
    /**
     * @test
     */
    public function it_supports(): void
    {
        self::assertTrue($this->getHydrator()->supports($this->getBlock(), $this->getData()));
    }

    /**
     * @test
     */
    public function it_hydrates(): void
    {
        $block = $this->getBlock();
        $this->getHydrator()->hydrate($block, $this->getData());

        $this->assert($block);
    }

    abstract protected function getBlock(): Block;

    abstract protected function getHydrator(): HydratorInterface;

    abstract protected function getData(): array;

    abstract protected function assert(Block $block): void;
}
