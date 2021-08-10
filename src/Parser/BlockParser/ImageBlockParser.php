<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser\BlockParser;

use Setono\CodexEditor\Parser\Block\Image\ImageBlock;

final class ImageBlockParser extends GenericBlockParser
{
    protected function getType(): string
    {
        return 'image';
    }

    protected function getBlockClass(): string
    {
        return ImageBlock::class;
    }
}
