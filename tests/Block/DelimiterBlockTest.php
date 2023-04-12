<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class DelimiterBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new DelimiterBlock('id');
    }
}
