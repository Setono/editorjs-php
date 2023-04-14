<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

final class EmbedBlock extends Block
{
    public function __construct(
        string $id,
        public readonly string $service,
        public readonly string $source,
        public readonly string $embed,
        public readonly int $width,
        public readonly int $height,
        public readonly ?string $caption = null,
    ) {
        parent::__construct($id);
    }

    /**
     * A helper method for the CSS attribute 'aspect-ratio'
     */
    public function getAspectRatio(): string
    {
        return sprintf('%d / %d', $this->width, $this->height);
    }
}
