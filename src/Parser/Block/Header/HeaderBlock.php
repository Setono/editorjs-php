<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Header;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\GenericBlock;
use Webmozart\Assert\Assert;

final class HeaderBlock extends GenericBlock implements HeaderBlockInterface
{
    private string $text;

    private int $level;

    public function __construct(string $id, string $type, string $text, int $level, array $data)
    {
        parent::__construct($id, $type, $data);

        $this->text = $text;
        $this->level = $level;
    }

    public static function createFromBlock(BlockInterface $block): self
    {
        $data = $block->getData();

        self::validate($data);

        return new self(
            $block->getId(),
            $block->getType(),
            $data['data']['text'],
            $data['data']['level'],
            $block->getData()
        );
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @psalm-assert array{data: array{text: string, level: int}} $data
     */
    protected static function validate(array $data): void
    {
        parent::validate($data);

        Assert::keyExists($data['data'], 'text');
        Assert::string($data['data']['text']);

        Assert::keyExists($data['data'], 'level');
        Assert::integer($data['data']['level']);
    }
}
