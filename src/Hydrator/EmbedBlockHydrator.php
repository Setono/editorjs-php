<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use Psl\Type;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\EmbedBlock;
use Webmozart\Assert\Assert;

final class EmbedBlockHydrator implements HydratorInterface
{
    /**
     * @param Block|EmbedBlock $block
     */
    public function hydrate(Block $block, array $data): void
    {
        Assert::true($this->supports($block, $data));

        $data = Type\shape([
            'data' => Type\shape([
                'service' => Type\string(),
                'source' => Type\string(),
                'embed' => Type\string(),
                'width' => Type\int(),
                'height' => Type\int(),
                'caption' => Type\string(),
            ]),
        ])->coerce($data);

        $block->service = $data['data']['service'];
        $block->source = $data['data']['source'];
        $block->embed = $data['data']['embed'];
        $block->width = $data['data']['width'];
        $block->height = $data['data']['height'];
        $block->caption = $data['data']['caption'] ?? null;
    }

    /**
     * @psalm-assert-if-true EmbedBlock $block
     */
    public function supports(Block $block, array $data): bool
    {
        return $block instanceof EmbedBlock;
    }
}
