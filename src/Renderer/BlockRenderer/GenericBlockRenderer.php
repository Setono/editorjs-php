<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer\BlockRenderer;

use Setono\EditorJS\Parser\Block\BlockInterface;

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
