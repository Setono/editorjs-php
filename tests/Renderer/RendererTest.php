<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Setono\EditorJS\Block\HeaderBlock;
use Setono\EditorJS\Block\ParagraphBlock;
use Setono\EditorJS\BlockRenderer\HeaderBlockRenderer;
use Setono\EditorJS\BlockRenderer\ParagraphBlockRenderer;
use Setono\EditorJS\Exception\UnsupportedBlockException;
use Setono\EditorJS\Parser\ParserResult;

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
        $parserResult = new ParserResult(new \DateTimeImmutable(), '2.3.4', [
            new HeaderBlock('id', 'Header', 1),
            new ParagraphBlock('id', 'Lorem ipsum'),
        ]);
        $renderer = new Renderer();
        $renderer->add(new HeaderBlockRenderer());
        $renderer->add(new ParagraphBlockRenderer());

        self::assertSame('<h1>Header</h1><p>Lorem ipsum</p>', $renderer->render($parserResult));
    }

    /**
     * @test
     */
    public function it_throws_exception_if_block_is_not_supported(): void
    {
        $this->expectException(UnsupportedBlockException::class);

        $parserResult = new ParserResult(new \DateTimeImmutable(), '2.3.4', [
            new HeaderBlock('id', 'Header', 1),
        ]);

        self::assertSame('<h1>Header</h1><p>Lorem ipsum</p>', (new Renderer())->render($parserResult));
    }

    /**
     * @test
     */
    public function it_does_not_throw_on_unsupported_block_if_throwing_is_disabled(): void
    {
        $parserResult = new ParserResult(new \DateTimeImmutable(), '2.3.4', [
            new HeaderBlock('id', 'Header', 1),
        ]);

        $logger = new class() extends AbstractLogger {
            public array $messages = [];

            public function log($level, $message, array $context = []): void
            {
                $this->messages[] = $message;
            }
        };

        $renderer = new Renderer();
        $renderer->setLogger($logger);
        $renderer->doNotThrowOnUnsupported();

        self::assertSame('', $renderer->render($parserResult));
        self::assertCount(1, $logger->messages);
    }
}
