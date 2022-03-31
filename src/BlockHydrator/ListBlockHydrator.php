<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Psl\Type;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ListBlock;
use Webmozart\Assert\Assert;

final class ListBlockHydrator implements BlockHydratorInterface
{
    /**
     * @param Block|ListBlock $block
     */
    public function hydrate(Block $block, array $data): void
    {
        Assert::true($this->supports($block, $data));

        $data = Type\shape([
            'data' => Type\shape([
                'style' => Type\string(),
                'items' => Type\vec(Type\string()),
            ]),
        ])->coerce($data);

        $block->style = $data['data']['style'];
        $block->items = $data['data']['items'];
    }

    /**
     * @psalm-assert-if-true ListBlock $block
     */
    public function supports(Block $block, array $data): bool
    {
        return $block instanceof ListBlock;
    }
}
