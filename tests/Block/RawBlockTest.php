<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class RawBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new RawBlock('id', '<h1>Header in HTML</h1>');
    }
}
