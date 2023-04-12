<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class EmbedBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new EmbedBlock('id', 'youtube', 'https://youtube.com/sadfas', 'https://youtube.com/embed/sadfas', 200, 150);
    }
}
