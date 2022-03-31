<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockHydrator;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Exception\HydratorException;

interface BlockHydratorInterface
{
    /**
     * Will move (hydrate) data from the given data array onto the given Block object
     *
     * @throws HydratorException if the given data is not supported
     */
    public function hydrate(Block $block, array $data): void;

    /**
     * Returns true if the hydrator supports the given block and data
     */
    public function supports(Block $block, array $data): bool;
}
