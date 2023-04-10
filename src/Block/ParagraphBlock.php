<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class ParagraphBlock extends Block
{
    public function __construct(string $id, string $type, public readonly string $text)
    {
        parent::__construct($id, $type);
    }
}
