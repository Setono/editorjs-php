<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

use Setono\EditorJS\Block\Image\File;

final class ImageBlock extends Block
{
    public function __construct(
        string $id,
        public readonly File $file,
        public readonly string $caption,
        public readonly bool $withBorder,
        public readonly bool $withBackground,
        public readonly bool $stretched,
    ) {
        parent::__construct($id);
    }

    /**
     * Returns true if the caption is not empty, i.e. $this->caption !== ''
     *
     * @psalm-assert-if-true non-empty-string $this->caption
     */
    public function hasCaption(): bool
    {
        return '' !== $this->caption;
    }
}
