<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class CodeBlock extends Block
{
    public function __construct(string $id, public readonly string $text)
    {
        parent::__construct($id);
    }
}
