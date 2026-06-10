<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\DelimiterBlock;
use Setono\EditorJS\Block\EmbedBlock;
use Setono\EditorJS\Block\HeaderBlock;
use Setono\EditorJS\Block\ImageBlock;
use Setono\EditorJS\Block\ListBlock;
use Setono\EditorJS\Block\ParagraphBlock;
use Setono\EditorJS\Block\QuoteBlock;
use Setono\EditorJS\Block\RawBlock;
use Setono\EditorJS\Exception\InvalidDataException;
use Setono\EditorJS\Exception\InvalidJsonException;
use Setono\EditorJS\Exception\MappingErrorException;
use Setono\EditorJS\Exception\ReservedKeyException;
use Setono\EditorJS\Exception\UnmappedTypeException;

final class Parser implements ParserInterface
{
    private ?MapperBuilder $mapperBuilder = null;

    /** @var array<string, class-string<Block>> */
    private array $mapping = [
        'delimiter' => DelimiterBlock::class,
        'embed' => EmbedBlock::class,
        'header' => HeaderBlock::class,
        'image' => ImageBlock::class,
        'list' => ListBlock::class,
        'paragraph' => ParagraphBlock::class,
        'quote' => QuoteBlock::class,
        'raw' => RawBlock::class,
    ];

    public function parse(string $json): ParserResult
    {
        try {
            $data = json_decode(json: $json, associative: true, flags: \JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new InvalidJsonException($json, $e);
        }

        try {
            $data = $this->getMapperBuilder()
                ->mapper()
                ->map(
                    'array{time: int, version: string, blocks: list<array{id: string, type: string, data: array<string, mixed>}>}',
                    $data,
                );
        } catch (MappingError $e) {
            throw new InvalidDataException($json, $e);
        }

        /** @var list<Block> $blocks */
        $blocks = [];

        foreach ($data['blocks'] as $block) {
            $mapping = $this->getMapping($block['type']);

            foreach (array_keys($block['data']) as $key) {
                if ('id' === $key) {
                    throw new ReservedKeyException($key, $block);
                }
            }

            try {
                $blocks[] = $this->getMapperBuilder()
                    ->mapper()
                    ->map($mapping, array_merge($block, $block['data']))
                ;
            } catch (MappingError $e) {
                throw new MappingErrorException($e, $block['type'], $mapping);
            }
        }

        return new ParserResult(
            new \DateTimeImmutable(sprintf('@%d', (int) ($data['time'] / 1000))), // the time is in milliseconds
            $data['version'],
            $blocks,
        );
    }

    public function getMapperBuilder(): MapperBuilder
    {
        if (null === $this->mapperBuilder) {
            $this->mapperBuilder = new MapperBuilder()
                ->allowSuperfluousKeys()
                ->allowPermissiveTypes()
            ;
        }

        return $this->mapperBuilder;
    }

    public function hasMapping(string $type): bool
    {
        return isset($this->mapping[$type]);
    }

    /**
     * @return class-string<Block>
     *
     * @throws UnmappedTypeException if the $type is not mapped
     */
    public function getMapping(string $type): string
    {
        if (!$this->hasMapping($type)) {
            throw new UnmappedTypeException($type);
        }

        return $this->mapping[$type];
    }

    /**
     * @param class-string<Block> $class
     */
    public function setMapping(string $type, string $class): void
    {
        $this->mapping[$type] = $class;
    }
}
