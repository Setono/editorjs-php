<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Psl\Type;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\HeaderBlock;
use Webmozart\Assert\Assert;

final class HeaderBlockHydrator implements BlockHydratorInterface
{
    /**
     * @param Block|HeaderBlock $block
     */
    public function hydrate(Block $block, array $data): void
    {
        Assert::true($this->supports($block, $data));

        $data = Type\shape([
            'data' => Type\shape([
                'text' => Type\string(),
                'level' => Type\int(),
            ]),
        ])->coerce($data);

        $block->text = $data['data']['text'];
        $block->level = $data['data']['level'];
    }

    /**
     * @psalm-assert-if-true HeaderBlock $block
     */
    public function supports(Block $block, array $data): bool
    {
        return $block instanceof HeaderBlock;
    }
}
