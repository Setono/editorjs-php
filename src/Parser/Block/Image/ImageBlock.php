<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Image;

use Setono\EditorJS\Parser\Block\BlockInterface;
use Setono\EditorJS\Parser\Block\GenericBlock;
use Webmozart\Assert\Assert;

final class ImageBlock extends GenericBlock implements ImageBlockInterface
{
    private File $file;

    private string $caption;

    private bool $withBorder;

    private bool $withBackground;

    private bool $stretched;

    public function __construct(
        string $id,
        string $type,
        File $file,
        string $caption,
        bool $withBorder,
        bool $withBackground,
        bool $stretched,
        array $data
    ) {
        parent::__construct($id, $type, $data);

        $this->file = $file;
        $this->caption = $caption;
        $this->withBorder = $withBorder;
        $this->withBackground = $withBackground;
        $this->stretched = $stretched;
    }

    public static function createFromBlock(BlockInterface $block): self
    {
        $data = $block->getData();

        self::validate($data);

        return new self(
            $block->getId(),
            $block->getType(),
            File::createFromData($data['data']['file']),
            $data['data']['caption'],
            $data['data']['withBorder'],
            $data['data']['withBackground'],
            $data['data']['stretched'],
            $block->getData()
        );
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function getCaption(): string
    {
        return $this->caption;
    }

    public function isWithBorder(): bool
    {
        return $this->withBorder;
    }

    public function isWithBackground(): bool
    {
        return $this->withBackground;
    }

    public function isStretched(): bool
    {
        return $this->stretched;
    }

    /**
     * @psalm-assert array{data: array{file: array, caption: string, withBorder: bool, withBackground: bool, stretched: bool}} $data
     */
    protected static function validate(array $data): void
    {
        parent::validate($data);

        Assert::keyExists($data['data'], 'file');
        Assert::isArray($data['data']['file']);

        Assert::keyExists($data['data'], 'caption');
        Assert::string($data['data']['caption']);

        Assert::keyExists($data['data'], 'withBorder');
        Assert::boolean($data['data']['withBorder']);

        Assert::keyExists($data['data'], 'withBackground');
        Assert::boolean($data['data']['withBackground']);

        Assert::keyExists($data['data'], 'stretched');
        Assert::boolean($data['data']['stretched']);
    }
}
