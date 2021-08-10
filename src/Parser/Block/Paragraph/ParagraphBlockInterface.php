<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser\Block\Paragraph;

use Setono\CodexEditor\Parser\Block\BlockInterface;

interface ParagraphBlockInterface extends BlockInterface
{
    public function getText(): string;
}
