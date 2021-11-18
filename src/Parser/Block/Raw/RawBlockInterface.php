<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Raw;

use Setono\EditorJS\Parser\Block\BlockInterface;

interface RawBlockInterface extends BlockInterface
{
    public function getHtml(): string;
}
