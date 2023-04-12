<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

use Setono\EditorJS\Block\Image\File;

final class ImageBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new ImageBlock('id', new File('https://example.com/image.jpg'), 'caption', true, true, true);
    }
}
