<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use Psl\Type;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\RawBlock;
use Webmozart\Assert\Assert;

final class RawBlockHydrator implements HydratorInterface
{
    /**
     * @param Block|RawBlock $block
     */
    public function hydrate(Block $block, array $data): void
    {
        Assert::true($this->supports($block, $data));

        $data = Type\shape([
            'data' => Type\shape([
                'html' => Type\string(),
            ]),
        ])->coerce($data);

        $block->html = $data['data']['html'];
    }

    /**
     * @psalm-assert-if-true RawBlock $block
     */
    public function supports(Block $block, array $data): bool
    {
        return $block instanceof RawBlock;
    }
}
