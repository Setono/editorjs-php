<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Parser\Block\Paragraph\ParagraphBlock;
use Setono\EditorJS\Parser\BlockList;
use Setono\EditorJS\Parser\ParserResult;
use Setono\EditorJS\Renderer\BlockRenderer\ParagraphBlockRenderer;

/**
 * @covers \Setono\EditorJS\Renderer\Renderer
 */
final class RendererTest extends TestCase
{
    /**
     * @test
     */
    public function it_renders(): void
    {
        $blockList = new BlockList();
        $blockList->add(new ParagraphBlock('asdf', 'paragraph', 'My text', []));

        $parsingResult = new ParserResult(new \DateTimeImmutable(), '2.0.0', $blockList);

        $renderer = new Renderer();
        $renderer->addBlockRenderer(new ParagraphBlockRenderer());

        $html = $renderer->render($parsingResult);

        self::assertSame('<p>My text</p>', $html);
    }
}
