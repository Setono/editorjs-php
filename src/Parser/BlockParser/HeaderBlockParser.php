<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\BlockParser;

use Setono\EditorJS\Parser\Block\Header\HeaderBlock;

final class HeaderBlockParser extends GenericBlockParser
{
    protected function getType(): string
    {
        return 'header';
    }

    protected function getBlockClass(): string
    {
        return HeaderBlock::class;
    }
}
