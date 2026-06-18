<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block\Image;

// todo right now it doesn't support the extra data you can set on the File object (see https://github.com/editor-js/image#providing-custom-uploading-methods)
final class File
{
    public function __construct(public readonly string $url)
    {
    }
}
