<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Decoder\PhpDecoder;

abstract class HydratorTestCase extends TestCase
{
    /**
     * @test
     */
    public function it_supports(): void
    {
        self::assertTrue($this->getHydrator()->supports($this->getBlock(), $this->getData($this->getJson())));
    }

    /**
     * @test
     */
    public function it_hydrates(): void
    {
        $block = $this->getBlock();
        $this->getHydrator()->hydrate($block, $this->getData($this->getJson()));

        $this->assert($block);
    }

    private function getData(string $json): array
    {
        return (new PhpDecoder())->decode($json);
    }

    abstract protected function getBlock(): Block;

    abstract protected function getHydrator(): BlockHydratorInterface;

    /**
     * It's much easier to get the JSON for each block so instead we convert the JSON in this test case when we need it
     */
    abstract protected function getJson(): string;

    abstract protected function assert(Block $block): void;
}
