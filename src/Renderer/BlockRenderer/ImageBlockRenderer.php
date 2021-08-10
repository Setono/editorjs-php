<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer\BlockRenderer;

use Setono\CodexEditor\Parser\Block\BlockInterface;
use Setono\CodexEditor\Parser\Block\Image\ImageBlockInterface;

final class ImageBlockRenderer extends GenericBlockRenderer
{
    public function render(BlockInterface $block): string
    {
        \assert($block instanceof ImageBlockInterface);

        // todo we don't use the withBorder, withBackground and stretched properties
        // todo should we use the OptionsResolver to allow for easy customization of this?
        return sprintf(
            '<div class="container-image"><div class="image"><img src="%s" alt="%s"></div><div class="caption">%s</div></div>',
            $block->getFile()->getUrl(),
            $block->getCaption(),
            $block->getCaption()
        );
    }

    protected function getInterface(): string
    {
        return ImageBlockInterface::class;
    }
}
