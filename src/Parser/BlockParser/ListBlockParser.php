<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser\BlockParser;

use Setono\CodexEditor\Parser\Block\ListBlock\ListBlock;

final class ListBlockParser extends GenericBlockParser
{
    protected function getType(): string
    {
        return 'list';
    }

    protected function getBlockClass(): string
    {
        return ListBlock::class;
    }
}
