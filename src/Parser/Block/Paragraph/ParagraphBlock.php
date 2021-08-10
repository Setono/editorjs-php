<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Paragraph;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\GenericBlock;
use Webmozart\Assert\Assert;

final class ParagraphBlock extends GenericBlock implements ParagraphBlockInterface
{
    private string $text;

    public function __construct(string $id, string $type, string $text, array $data)
    {
        parent::__construct($id, $type, $data);

        $this->text = $text;
    }

    public static function createFromBlock(BlockInterface $block): self
    {
        $data = $block->getData();

        self::validate($data);

        return new self(
            $block->getId(),
            $block->getType(),
            $data['data']['text'],
            $block->getData()
        );
    }

    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @psalm-assert array{data: array{text: string}} $data
     */
    protected static function validate(array $data): void
    {
        parent::validate($data);

        Assert::keyExists($data['data'], 'text');
        Assert::string($data['data']['text']);
    }
}
