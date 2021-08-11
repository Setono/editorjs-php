<?php

declare(strict_types=1);

// the 'Block' in 'ListBlock' is only because reserved keywords cannot be part of a namespace before PHP8

namespace Setono\EditorJS\Parser\Block\ListBlock;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\GenericBlock;
use Webmozart\Assert\Assert;

final class ListBlock extends GenericBlock implements ListBlockInterface
{
    private string $style;

    /** @var array<array-key, string> */
    private array $items;

    /**
     * @param array<array-key, string> $items
     */
    public function __construct(string $id, string $type, string $style, array $items, array $data)
    {
        parent::__construct($id, $type, $data);

        $this->style = $style;
        $this->items = $items;
    }

    /**
     * @return list<string>
     */
    public static function getStyles(): array
    {
        return [self::STYLE_ORDERED, self::STYLE_UNORDERED];
    }

    public static function createFromBlock(BlockInterface $block): self
    {
        $data = $block->getData();

        self::validate($data);

        return new self(
            $block->getId(),
            $block->getType(),
            $data['data']['style'],
            $data['data']['items'],
            $block->getData()
        );
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @psalm-assert array{data: array{style: string, items: array<array-key, string>}} $data
     */
    protected static function validate(array $data): void
    {
        parent::validate($data);

        Assert::keyExists($data['data'], 'style');
        Assert::string($data['data']['style']);
        Assert::oneOf($data['data']['style'], self::getStyles());

        Assert::keyExists($data['data'], 'items');
        Assert::isArray($data['data']['items']);
        Assert::allString($data['data']['items']);
    }
}
