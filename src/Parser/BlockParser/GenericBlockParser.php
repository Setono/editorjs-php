<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\BlockParser;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Webmozart\Assert\Assert;

abstract class GenericBlockParser implements BlockParserInterface
{
    public function parse(BlockInterface $block): BlockInterface
    {
        $result = call_user_func([$this->getBlockClass(), 'createFromBlock'], $block);
        Assert::isInstanceOf($result, BlockInterface::class);

        return $result;
    }

    public function supports(BlockInterface $block): bool
    {
        return $block->getType() === $this->getType();
    }

    /**
     * The type this block parser supports
     */
    abstract protected function getType(): string;

    /**
     * @return class-string
     */
    abstract protected function getBlockClass(): string;
}
