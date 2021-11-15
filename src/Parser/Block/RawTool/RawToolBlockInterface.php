<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\RawTool;

use Setono\EditorJS\Parser\Block\BlockInterface;

interface RawToolBlockInterface extends BlockInterface
{
    public function getHtml(): string;
}
