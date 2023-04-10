<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class File
{
    public function __construct(public readonly string $url)
    {
    }
}
