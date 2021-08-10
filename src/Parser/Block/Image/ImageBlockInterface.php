<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Image;

use Setono\EditorJS\Parser\Block\BlockInterface;

interface ImageBlockInterface extends BlockInterface
{
    public function getFile(): File;

    public function getCaption(): string;

    public function isWithBorder(): bool;

    public function isWithBackground(): bool;

    public function isStretched(): bool;
}
