<?php

declare(strict_types=1);

namespace Setono\CodexEditor\Renderer;

use PHPUnit\Framework\TestCase;
use Setono\CodexEditor\Parser\Block\Paragraph\ParagraphBlock;
use Setono\CodexEditor\Parser\BlockList;
use Setono\CodexEditor\Parser\Result;
use Setono\CodexEditor\Renderer\BlockRenderer\ParagraphBlockRenderer;

/**
 * @covers \Setono\CodexEditor\Renderer\Renderer
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

        $parsingResult = new Result(new \DateTimeImmutable(), '2.0.0', $blockList);

        $renderer = new Renderer();
        $renderer->addBlockRenderer(new ParagraphBlockRenderer());

        $html = $renderer->render($parsingResult);

        self::assertSame('<p>My text</p>', $html);
    }
}
