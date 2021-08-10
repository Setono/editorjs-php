<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Paragraph;

use Setono\EditorJS\Parser\Block\BlockInterface;

interface ParagraphBlockInterface extends BlockInterface
{
    public function getText(): string;
}
