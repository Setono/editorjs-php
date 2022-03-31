<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

// todo right now it doesn't support the extra data you can set on the File object (see https://github.com/editor-js/image#providing-custom-uploading-methods)
final class ImageBlock extends Block
{
    public string $url;

    public string $caption;

    public bool $withBorder;

    public bool $withBackground;

    public bool $stretched;
}
