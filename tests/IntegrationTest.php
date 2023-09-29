<?php

declare(strict_types=1);

namespace Setono\EditorJS;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\BlockRenderer\DelimiterBlockRenderer;
use Setono\EditorJS\BlockRenderer\HeaderBlockRenderer;
use Setono\EditorJS\BlockRenderer\ImageBlockRenderer;
use Setono\EditorJS\BlockRenderer\ListBlockRenderer;
use Setono\EditorJS\BlockRenderer\ParagraphBlockRenderer;
use Setono\EditorJS\BlockRenderer\QuoteBlockRenderer;
use Setono\EditorJS\BlockRenderer\RawBlockRenderer;
use Setono\EditorJS\Parser\Parser;
use Setono\EditorJS\Renderer\Renderer;

final class IntegrationTest extends TestCase
{
    /**
     * @test
     */
    public function it_parses_and_renders(): void
    {
        $parser = new Parser();
        $parserResult = $parser->parse($this->getInput());

        self::assertSame('2022-03-31', $parserResult->time->format('Y-m-d'));
        self::assertSame('2.23.1', $parserResult->version);
        self::assertCount(15, $parserResult->blocks);

        $renderer = new Renderer();
        $renderer->add(new DelimiterBlockRenderer());
        $renderer->add(new HeaderBlockRenderer());
        $renderer->add(new ImageBlockRenderer());
        $renderer->add(new ListBlockRenderer());
        $renderer->add(new ParagraphBlockRenderer());
        $renderer->add(new RawBlockRenderer());
        $renderer->add(new QuoteBlockRenderer());

        $renderer->render($parserResult);
    }

    private function getInput(): string
    {
        return <<<JSON
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
        },
        {
            "id": "g-y5teN5qG",
            "type": "quote",
            "data": {
                "text": "We are the champions",
                "caption": "Queen",
                "alignment": "left"
            }
        }
    ],
    "version" : "2.23.1"
}
JSON;
    }
}
