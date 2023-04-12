<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class ParagraphBlockTest extends BlockTestCase
{
    protected function getBlock(): Block
    {
        return new ParagraphBlock('id', 'Paragraph');
    }
}
