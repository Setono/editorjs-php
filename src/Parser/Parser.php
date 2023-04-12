<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use Psl\Type;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Block\DelimiterBlock;
use Setono\EditorJS\Block\EmbedBlock;
use Setono\EditorJS\Block\HeaderBlock;
use Setono\EditorJS\Block\ImageBlock;
use Setono\EditorJS\Block\ListBlock;
use Setono\EditorJS\Block\ParagraphBlock;
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
        'raw' => RawBlock::class,
    ];

    public function parse(string $json): ParserResult
    {
        try {
            $data = json_decode($json, true, 512, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new InvalidJsonException($json, $e);
        }

        $specification = Type\shape([
            'time' => Type\int(),
            'version' => Type\string(),
            'blocks' => Type\vec(Type\shape([
                'id' => Type\string(),
                'type' => Type\string(),
                'data' => Type\mixed_dict(),
            ])),
        ]);

        try {
            $data = $specification->assert($data);
        } catch (Type\Exception\AssertException $e) {
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
            $this->mapperBuilder = (new MapperBuilder())->allowSuperfluousKeys();
        }

        return $this->mapperBuilder;
    }

    /**
     * @psalm-assert-if-true class-string<Block> $this->mapping[$type]
     */
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
