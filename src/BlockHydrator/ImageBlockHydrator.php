<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Psl\Type;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ImageBlock;
use Webmozart\Assert\Assert;

final class ImageBlockHydrator implements BlockHydratorInterface
{
    /**
     * @param Block|ImageBlock $block
     */
    public function hydrate(Block $block, array $data): void
    {
        Assert::true($this->supports($block, $data));

        $data = Type\shape([
            'data' => Type\shape([
                'file' => Type\shape([
                    'url' => Type\string(),
                ]),
                'caption' => Type\string(),
                'withBorder' => Type\bool(),
                'withBackground' => Type\bool(),
                'stretched' => Type\bool(),
            ]),
        ])->coerce($data);

        $block->url = $data['data']['file']['url'];
        $block->caption = $data['data']['caption'];
        $block->withBorder = $data['data']['withBorder'];
        $block->withBackground = $data['data']['withBackground'];
        $block->stretched = $data['data']['stretched'];
    }

    /**
     * @psalm-assert-if-true ImageBlock $block
     */
    public function supports(Block $block, array $data): bool
    {
        return $block instanceof ImageBlock;
    }
}
