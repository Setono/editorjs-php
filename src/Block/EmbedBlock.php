<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class EmbedBlock extends Block
{
    public string $service;

    public string $source;

    public string $embed;

    public int $width;

    public int $height;

    public ?string $caption;
}
