<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\BlockParser;

use Setono\EditorJS\Parser\Block\RawTool\RawToolBlock;

final class RawToolParser extends GenericBlockParser
{
    protected function getType(): string
    {
        return 'rawTool';
    }

    protected function getBlockClass(): string
    {
        return RawToolBlock::class;
    }
}
