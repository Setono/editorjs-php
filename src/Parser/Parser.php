<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\DelimiterBlock;
use Setono\EditorJS\Block\EmbedBlock;
use Setono\EditorJS\Block\HeaderBlock;
use Setono\EditorJS\Block\ImageBlock;
use Setono\EditorJS\Block\ListBlock;
use Setono\EditorJS\Block\ParagraphBlock;
use Setono\EditorJS\Block\RawBlock;
use Setono\EditorJS\Decoder\DecoderInterface;
use Setono\EditorJS\Decoder\PhpDecoder;
use Setono\EditorJS\Exception\ParserException;
use Setono\EditorJS\Hydrator\HydratorInterface;
use Webmozart\Assert\Assert;

final class Parser implements ParserInterface
{
    private HydratorInterface $hydrator;

    private DecoderInterface $decoder;

    /** @var array<string, class-string<Block>> */
    private array $typeToBlockMapping = [
        'delimiter' => DelimiterBlock::class,
        'embed' => EmbedBlock::class,
        'header' => HeaderBlock::class,
        'image' => ImageBlock::class,
        'list' => ListBlock::class,
        'paragraph' => ParagraphBlock::class,
        'raw' => RawBlock::class,
    ];

    /**
     * @param array<string, class-string<Block>>|null $typeToBlockMapping
     */
    public function __construct(HydratorInterface $hydrator, DecoderInterface $decoder = null, array $typeToBlockMapping = null)
    {
        $this->hydrator = $hydrator;
        $this->decoder = $decoder ?? new PhpDecoder();

        if (null !== $typeToBlockMapping) {
            $this->typeToBlockMapping = array_merge($this->typeToBlockMapping, $typeToBlockMapping);
        }
    }

    public function parse(string $json): ParserResult
    {
        try {
            $data = $this->decoder->decode($json);
        } catch (\Throwable $e) {
            throw ParserException::invalidJson($e->getMessage());
        }

        try {
            self::validate($data);
        } catch (\InvalidArgumentException $e) {
            throw ParserException::invalidData($e->getMessage());
        }

        $blocks = [];

        foreach ($data['blocks'] as $blockData) {
            if (!is_array($blockData) || !isset($blockData['type']) || !is_string($blockData['type'])) {
                throw ParserException::invalidType($blockData);
            }

            if (!isset($this->typeToBlockMapping[$blockData['type']])) {
                throw ParserException::unmappedBlockType($blockData['type']);
            }

            /** @var Block $block */
            $block = new $this->typeToBlockMapping[$blockData['type']]();

            if (!$this->hydrator->supports($block, $blockData)) {
                throw ParserException::unsupportedBlockType($blockData['type']);
            }

            $this->hydrator->hydrate($block, $blockData);

            $blocks[] = $block;
        }

        $time = new \DateTimeImmutable(sprintf('@%d', $data['time']));

        return new ParserResult($time, $data['version'], $blocks);
    }

    /** @psalm-assert array{time: int, version: string, blocks: array<array-key, mixed>} $data */
    private static function validate(array $data): void
    {
        Assert::keyExists($data, 'time');
        Assert::integer($data['time']);

        Assert::keyExists($data, 'version');
        Assert::string($data['version']);

        Assert::keyExists($data, 'blocks');
        Assert::isArray($data['blocks']);
    }
}
