<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\Block;
use Setono\HtmlElement\HtmlElement;

interface BlockRendererInterface
{
    public function render(Block $block): HtmlElement;

    public function supports(Block $block): bool;
}
