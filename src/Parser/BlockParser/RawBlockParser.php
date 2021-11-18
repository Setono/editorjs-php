<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\BlockParser;

use Setono\EditorJS\Parser\Block\Raw\RawBlock;

final class RawBlockParser extends GenericBlockParser
{
    protected function getType(): string
    {
        return 'raw';
    }

    protected function getBlockClass(): string
    {
        return RawBlock::class;
    }
}
