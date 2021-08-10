<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\BlockParser;

use Setono\EditorJS\Parser\Block\Delimiter\DelimiterBlock;

final class DelimiterBlockParser extends GenericBlockParser
{
    protected function getType(): string
    {
        return 'delimiter';
    }

    protected function getBlockClass(): string
    {
        return DelimiterBlock::class;
    }
}
