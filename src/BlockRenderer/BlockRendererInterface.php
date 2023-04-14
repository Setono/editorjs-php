<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Exception\RendererExceptionInterface;
use Setono\HtmlElement\HtmlElement;

/**
 * Implement this interface for each of your blocks
 */
interface BlockRendererInterface
{
    /**
     * @throws RendererExceptionInterface
     */
    public function render(Block $block): HtmlElement|string;

    public function supports(Block $block): bool;
}
