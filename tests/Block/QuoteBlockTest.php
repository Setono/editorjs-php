<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class QuoteBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new QuoteBlock('id', 'Quote', 'Author', 'left');
    }
}
