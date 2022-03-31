<?php

declare(strict_types=1);

namespace Setono\EditorJS\Hydrator;

use Psl\Type;
use Setono\EditorJS\Block\Block;

final class CompositeHydrator implements HydratorInterface
{
    /**
     * @var list<HydratorInterface>
     */
    private array $hydrators = [];

    public function add(HydratorInterface $hydrator): void
    {
        $this->hydrators[] = $hydrator;
    }

    public function hydrate(Block $block, array $data): void
    {
        foreach ($this->hydrators as $hydrator) {
            if($hydrator->supports($block, $data)) {
                $hydrator->hydrate($block, $data);
            }
        }
    }

    public function supports(Block $block, array $data): bool
    {
        foreach ($this->hydrators as $hydrator) {
            if($hydrator->supports($block, $data)) {
                return true;
            }
        }

        return false;
    }
}
