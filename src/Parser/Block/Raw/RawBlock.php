<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Raw;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\GenericBlock;
use Webmozart\Assert\Assert;

final class RawBlock extends GenericBlock implements RawBlockInterface
{
    private string $html;

    public function __construct(string $id, string $type, string $html, array $data)
    {
        parent::__construct($id, $type, $data);

        $this->html = $html;
    }

    public static function createFromBlock(BlockInterface $block): self
    {
        $data = $block->getData();

        self::validate($data);

        return new self(
            $block->getId(),
            $block->getType(),
            $data['data']['html'],
            $block->getData()
        );
    }

    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @psalm-assert array{data: array{html: string}} $data
     */
    protected static function validate(array $data): void
    {
        parent::validate($data);

        Assert::keyExists($data['data'], 'html');
        Assert::string($data['data']['html']);
    }
}
