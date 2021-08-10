<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\BlockParser;

use Setono\EditorJS\Parser\Block\Paragraph\ParagraphBlock;

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
