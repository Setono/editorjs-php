<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser\BlockParser;

use Setono\CodexEditor\Parser\Block\Paragraph\ParagraphBlock;

final class ParagraphBlockParser extends GenericBlockParser
{
    protected function getType(): string
    {
        return 'paragraph';
    }

    protected function getBlockClass(): string
    {
        return ParagraphBlock::class;
    }
}
