<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Parser\Block\Image;

use Setono\CodexEditor\Parser\Block\BlockInterface;

interface ImageBlockInterface extends BlockInterface
{
    public function getFile(): File;

    public function getCaption(): string;

    public function isWithBorder(): bool;

    public function isWithBackground(): bool;

    public function isStretched(): bool;
}
