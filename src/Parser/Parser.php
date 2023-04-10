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

// todo add a configuration option to not throw exceptions, but log them instead
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

    /**
     * @throws MappingError if it's not possible to map a block to a DTO
     * @throws \JsonException if the json is not valid JSON
     */
    public function parse(string $json): ParserResult
    {
        $data = json_decode($json, true, 512, \JSON_THROW_ON_ERROR);
        $specification = Type\shape([
            'time' => Type\int(),
            'version' => Type\string(),
            'blocks' => Type\vec(Type\shape([
                'id' => Type\string(),
                'type' => Type\string(),
                'data' => Type\mixed_dict(),
            ])),
        ]);

        $data = $specification->assert($data);

        /** @var list<Block> $blocks */
        $blocks = [];

        foreach ($data['blocks'] as $block) {
            if (!$this->hasMapping($block['type'])) {
                throw new \InvalidArgumentException(sprintf('No mapping found for the type "%s"', $block['type']));
            }

            foreach (array_keys($block['data']) as $key) {
                if (in_array($key, ['id', 'type'])) {
                    throw new \InvalidArgumentException(sprintf('The block with id "%s" has a reserved key in its data (%s)', $block['id'], $key));
                }
            }

            /** @psalm-suppress MixedAssignment */
            $blocks[] = $this->getMapperBuilder()
                ->mapper()
                ->map($this->mapping[$block['type']], array_merge($block, $block['data']))
            ;
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

    public function hasMapping(string $type): bool
    {
        return isset($this->mapping[$type]);
    }

    /**
     * @param class-string<Block> $class
     */
    public function setMapping(string $type, string $class): void
    {
        $this->mapping[$type] = $class;
    }
}
