<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

// todo right now it doesn't support the extra data you can set on the File object (see https://github.com/editor-js/image#providing-custom-uploading-methods)
final class ImageBlock extends Block
{
    public function __construct(
        string $id,
        string $type,
        public readonly File $file,
        public readonly string $caption,
        public readonly bool $withBorder,
        public readonly bool $withBackground,
        public readonly bool $stretched,
    ) {
        parent::__construct($id, $type);
    }
}
