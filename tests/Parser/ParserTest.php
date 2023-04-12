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

    /**
     * @test
     */
    public function it_parses(): void
    {
        $json = <<<JSON
{
    "time" : 1648714636619,
    "blocks" : [
        {
            "id" : "ddqzqrksLS",
            "type" : "header",
            "data" : {
                "text" : "Editor.js",
                "level" : 2
            }
        },
        {
            "id" : "y-xD62aVSs",
            "type" : "paragraph",
            "data" : {
                "text" : "Hey. Meet the new Editor. On this page you can see it in action — try to edit this text."
            }
        },
        {
            "id" : "JsFDw3oujK",
            "type" : "header",
            "data" : {
                "text" : "Key features",
                "level" : 3
            }
        },
        {
            "id" : "W7cxS38p72",
            "type" : "list",
            "data" : {
                "style" : "unordered",
                "items" : [
                    "It is a block-styled editor",
                    "It returns clean data output in JSON",
                    "Designed to be extendable and pluggable with a simple API"
                ]
            }
        },
        {
            "id" : "59z0qpoRto",
            "type" : "header",
            "data" : {
                "text" : "What does it mean «block-styled editor»",
                "level" : 3
            }
        },
        {
            "id" : "KwD6DL5mwr",
            "type" : "paragraph",
            "data" : {
                "text" : "Workspace in classic editors is made of a single contenteditable element, used to create different HTML markups. Editor.js <mark class=\"cdx-marker\">workspace consists of separate Blocks: paragraphs, headings, images, lists, quotes, etc</mark>. Each of them is an independent contenteditable element (or more complex structure) provided by Plugin and united by Editor's Core."
            }
        },
        {
            "id" : "gz9NmNc07B",
            "type" : "paragraph",
            "data" : {
                "text" : "There are dozens of <a href=\"https://github.com/editor-js\">ready-to-use Blocks</a> and the <a href=\"https://editorjs.io/creating-a-block-tool\">simple API</a> for creation any Block you need. For example, you can implement Blocks for Tweets, Instagram posts, surveys and polls, CTA-buttons and even games."
            }
        },
        {
            "id" : "PRFZV4qY6Q",
            "type" : "header",
            "data" : {
                "text" : "What does it mean clean data output",
                "level" : 3
            }
        },
        {
            "id" : "4Ps-zHrERz",
            "type" : "paragraph",
            "data" : {
                "text" : "Classic WYSIWYG-editors produce raw HTML-markup with both content data and content appearance. On the contrary, Editor.js outputs JSON object with data of each Block. You can see an example below"
            }
        },
        {
            "id" : "tO01RYnEjt",
            "type" : "paragraph",
            "data" : {
                "text" : "Given data can be used as you want: render with HTML for <code class=\"inline-code\">Web clients</code>, render natively for <code class=\"inline-code\">mobile apps</code>, create markup for <code class=\"inline-code\">Facebook Instant Articles</code> or <code class=\"inline-code\">Google AMP</code>, generate an <code class=\"inline-code\">audio version</code> and so on."
            }
        },
        {
            "id" : "36yInXCuYz",
            "type" : "paragraph",
            "data" : {
                "text" : "Clean data is useful to sanitize, validate and process on the backend."
            }
        },
        {
            "id" : "60bwNzOlDg",
            "type" : "delimiter",
            "data" : {}
        },
        {
            "id" : "jr5I6hVhs8",
            "type" : "paragraph",
            "data" : {
                "text" : "We have been working on this project more than three years. Several large media projects help us to test and debug the Editor, to make it's core more stable. At the same time we significantly improved the API. Now, it can be used to create any plugin for any task. Hope you enjoy. 😏"
            }
        },
        {
            "id" : "rz-kI4Kemj",
            "type" : "image",
            "data" : {
                "file" : {
                    "url" : "https://codex.so/public/app/img/external/codex2x.png"
                },
                "caption" : "",
                "withBorder" : false,
                "stretched" : false,
                "withBackground" : false
            }
        }
    ],
    "version" : "2.23.1"
}
JSON;

        $parser = new Parser();
        $parserResult = $parser->parse($json);

        self::assertSame('2022-03-31', $parserResult->time->format('Y-m-d'));
        self::assertSame('2.23.1', $parserResult->version);
        self::assertCount(14, $parserResult->blocks);
    }
}

final class TestBlock extends Block
{
}
