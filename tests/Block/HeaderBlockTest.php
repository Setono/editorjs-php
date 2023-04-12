<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class HeaderBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new HeaderBlock('id', 'Header', 1);
    }
}
