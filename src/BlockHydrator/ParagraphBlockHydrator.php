<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Psl\Type;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\ParagraphBlock;
use Webmozart\Assert\Assert;

final class ParagraphBlockHydrator implements BlockHydratorInterface
{
    /**
     * @param Block|ParagraphBlock $block
     */
    public function hydrate(Block $block, array $data): void
    {
        Assert::true($this->supports($block, $data));

        $data = Type\shape([
            'data' => Type\shape([
                'text' => Type\string(),
            ]),
        ])->coerce($data);

        $block->text = $data['data']['text'];
    }

    /**
     * @psalm-assert-if-true ParagraphBlock $block
     */
    public function supports(Block $block, array $data): bool
    {
        return $block instanceof ParagraphBlock;
    }
}
