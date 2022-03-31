<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Psl\Type;
use Setono\EditorJS\Block\Block;

final class BlockHydrator implements BlockHydratorInterface
{
    public function hydrate(Block $block, array $data): void
    {
        $data = Type\shape([
            'id' => Type\string(),
            'type' => Type\string(),
            'data' => Type\dict(Type\string(), Type\mixed()),
        ])->coerce($data);

        $block->id = $data['id'];
        $block->type = $data['type'];
        $block->data = $data['data'];
    }

    public function supports(Block $block, array $data): bool
    {
        return true;
    }
}
