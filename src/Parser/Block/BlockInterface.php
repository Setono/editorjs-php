<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block;

interface BlockInterface
{
    public function getId(): string;

    public function getType(): string;

    public function getData(): array;
}
