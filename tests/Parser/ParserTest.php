<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Decoder\PhpDecoder;
use Setono\EditorJS\Parser\BlockParser\DelimiterBlockParser;
use Setono\EditorJS\Parser\BlockParser\HeaderBlockParser;
use Setono\EditorJS\Parser\BlockParser\ImageBlockParser;
use Setono\EditorJS\Parser\BlockParser\ListBlockParser;
use Setono\EditorJS\Parser\BlockParser\ParagraphBlockParser;
use Setono\EditorJS\Parser\BlockParser\RawBlockParser;

/**
 * @covers \Setono\EditorJS\Parser\Parser
 */
final class ParserTest extends TestCase
{
    /**
     * @test
     */
    public function it_parses(): void
    {
        $parser = new Parser(new PhpDecoder());
        $parser->addBlockParser(new HeaderBlockParser());
        $parser->addBlockParser(new ParagraphBlockParser());
        $parser->addBlockParser(new ListBlockParser());
        $parser->addBlockParser(new DelimiterBlockParser());
        $parser->addBlockParser(new ImageBlockParser());
        $parser->addBlockParser(new RawBlockParser());

        $parser->parse(self::getTestData());

        self::assertTrue(true);
    }

    private static function getTestData(): string
    {
        return <<<DATA
{
    "time" : 1636987638579,
    "blocks" : [
        {
            "id" : "JVED_-yLPI",
            "type" : "header",
            "data" : {
                "text" : "Editor.js",
                "level" : 2
            }
        },
        {
            "id" : "q_mNayd7m_",
            "type" : "paragraph",
            "data" : {
                "text" : "Hey. Meet the new Editor. On this page you can see it in action — try to edit this text."
            }
        },
        {
            "id" : "MR9Gs06p6e",
            "type" : "header",
            "data" : {
                "text" : "Key features",
                "level" : 3
            }
        },
        {
            "id" : "taw2uCRvva",
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
            "id" : "XEvXNqFkIm",
            "type" : "header",
            "data" : {
                "text" : "What does it mean «block-styled editor»",
                "level" : 3
            }
        },
        {
            "id" : "59snV7cq3t",
            "type" : "paragraph",
            "data" : {
                "text" : "Workspace in classic editors is made of a single contenteditable element, used to create different HTML markups. Editor.js <mark class=\"cdx-marker\">workspace consists of separate Blocks: paragraphs, headings, images, lists, quotes, etc</mark>. Each of them is an independent contenteditable element (or more complex structure) provided by Plugin and united by Editor's Core."
            }
        },
        {
            "id" : "cRc1kqGIPe",
            "type" : "paragraph",
            "data" : {
                "text" : "There are dozens of <a href=\"https://github.com/editor-js\">ready-to-use Blocks</a> and the <a href=\"https://editorjs.io/creating-a-block-tool\">simple API</a> for creation any Block you need. For example, you can implement Blocks for Tweets, Instagram posts, surveys and polls, CTA-buttons and even games."
            }
        },
        {
            "id" : "C6dvxuiW83",
            "type" : "header",
            "data" : {
                "text" : "What does it mean clean data output",
                "level" : 3
            }
        },
        {
            "id" : "XDoqP4Z6Qi",
            "type" : "paragraph",
            "data" : {
                "text" : "Classic WYSIWYG-editors produce raw HTML-markup with both content data and content appearance. On the contrary, Editor.js outputs JSON object with data of each Block. You can see an example below"
            }
        },
        {
            "id" : "wYKmSNY0wp",
            "type" : "paragraph",
            "data" : {
                "text" : "Given data can be used as you want: render with HTML for <code class=\"inline-code\">Web clients</code>, render natively for <code class=\"inline-code\">mobile apps</code>, create markup for <code class=\"inline-code\">Facebook Instant Articles</code> or <code class=\"inline-code\">Google AMP</code>, generate an <code class=\"inline-code\">audio version</code> and so on."
            }
        },
        {
            "id" : "t3cDSauN9t",
            "type" : "paragraph",
            "data" : {
                "text" : "Clean data is useful to sanitize, validate and process on the backend."
            }
        },
        {
            "id" : "HzaeH6xIxi",
            "type" : "raw",
            "data" : {
                "html" : "Some custom HTML"
            }
        },
        {
            "id" : "Gl-lg5ceYg",
            "type" : "delimiter",
            "data" : {}
        },
        {
            "id" : "ickzrYEM9E",
            "type" : "paragraph",
            "data" : {
                "text" : "We have been working on this project more than three years. Several large media projects help us to test and debug the Editor, to make it's core more stable. At the same time we significantly improved the API. Now, it can be used to create any plugin for any task. Hope you enjoy. 😏"
            }
        },
        {
            "id" : "3N-0F7PDlx",
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
    "version" : "2.22.2"
}
DATA;
    }
}
