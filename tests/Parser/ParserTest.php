<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Exception\InvalidDataException;
use Setono\EditorJS\Exception\InvalidJsonException;
use Setono\EditorJS\Exception\MappingErrorException;
use Setono\EditorJS\Exception\ReservedKeyException;
use Setono\EditorJS\Exception\UnmappedTypeException;

/**
 * @covers \Setono\EditorJS\Parser\Parser
 */
final class ParserTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception_if_json_is_invalid(): void
    {
        $this->expectException(InvalidJsonException::class);

        $parser = new Parser();
        $parser->parse('invalid json');
    }

    /**
     * @test
     */
    public function it_throws_exception_if_time_is_missing_from_data(): void
    {
        $this->expectException(InvalidDataException::class);

        $parser = new Parser();
        $parser->parse('{"blocks" : [],"version" : "2.23.1"}');
    }

    /**
     * @test
     */
    public function it_throws_exception_if_version_is_missing_from_data(): void
    {
        $this->expectException(InvalidDataException::class);

        $parser = new Parser();
        $parser->parse('{"time" : 1648714636619,"blocks" : []}');
    }

    /**
     * @test
     */
    public function it_throws_exception_if_blocks_are_missing_from_data(): void
    {
        $this->expectException(InvalidDataException::class);

        $parser = new Parser();
        $parser->parse('{"time" : 1648714636619,"version" : "2.23.1"}');
    }

    /**
     * @test
     */
    public function it_throws_exception_if_a_block_does_not_have_a_mapping(): void
    {
        $this->expectException(UnmappedTypeException::class);

        $json = <<<JSON
{
    "time" : 1648714636619,
    "blocks" : [
        {
            "id" : "ddqzqrksLS",
            "type" : "unmapped_block",
            "data" : {
                "text" : "Editor.js",
                "level" : 2
            }
        }
    ],
    "version" : "2.23.1"
}
JSON;

        $parser = new Parser();
        $parser->parse($json);
    }

    /**
     * @test
     */
    public function it_throws_exception_if_data_has_reserved_key(): void
    {
        $this->expectException(ReservedKeyException::class);

        $json = <<<JSON
{
    "time" : 1648714636619,
    "blocks" : [
        {
            "id" : "ddqzqrksLS",
            "type" : "header",
            "data" : {
                "id" : "reserved key"
            }
        }
    ],
    "version" : "2.23.1"
}
JSON;

        $parser = new Parser();
        $parser->parse($json);
    }

    /**
     * @test
     */
    public function it_throws_exception_if_data_cannot_be_mapped(): void
    {
        $this->expectException(MappingErrorException::class);

        $json = <<<JSON
{
    "time" : 1648714636619,
    "blocks" : [
        {
            "id" : "ddqzqrksLS",
            "type" : "header",
            "data" : {
                "key1" : "value1"
            }
        }
    ],
    "version" : "2.23.1"
}
JSON;

        $parser = new Parser();
        $parser->parse($json);
    }

    /**
     * @test
     */
    public function it_exposes_the_mapper_builder(): void
    {
        $parser = new Parser();
        $mapperBuilder = $parser->getMapperBuilder();

        self::assertSame($mapperBuilder, $parser->getMapperBuilder());
    }

    /**
     * @test
     */
    public function it_has_mapping_capabilities(): void
    {
        $parser = new Parser();
        $parser->setMapping('test', TestBlock::class);
        self::assertTrue($parser->hasMapping('test'));
        self::assertSame(TestBlock::class, $parser->getMapping('test'));
    }
}

final class TestBlock extends Block
{
}
