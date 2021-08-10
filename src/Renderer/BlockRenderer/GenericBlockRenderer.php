<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer\BlockRenderer;

use Setono\CodexEditor\Parser\Block\BlockInterface;

abstract class GenericBlockRenderer implements BlockRendererInterface
{
    public function supports(BlockInterface $block): bool
    {
        return is_a($block, $this->getInterface(), true);
    }

    /**
     * @return class-string
     */
    abstract protected function getInterface(): string;
}
