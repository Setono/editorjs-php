<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use PHPUnit\Framework\TestCase;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Exception\OptionsResolverException;
use Setono\EditorJS\Exception\UndefinedOptionException;
use Setono\HtmlElement\HtmlElement;

/**
 * @covers \Setono\EditorJS\BlockRenderer\GenericBlockRenderer
 */
final class GenericBlockRendererTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception_if_option_is_not_set(): void
    {
        $blockRenderer = new class() extends GenericBlockRenderer {
            public function render(Block $block): HtmlElement
            {
                if (!$this->hasOption('undefined_option')) {
                    $this->getOption('undefined_option');
                }

                return new HtmlElement('div');
            }

            public function supports(Block $block): bool
            {
                return true;
            }
        };

        $this->expectException(UndefinedOptionException::class);
        $blockRenderer->render(new GenericBlock());
    }

    /**
     * @test
     */
    public function it_throws_exception_if_you_try_to_set_an_invalid_option(): void
    {
        $this->expectException(OptionsResolverException::class);

        new class() extends GenericBlockRenderer {
            public function __construct()
            {
                parent::__construct([
                    'invalid_option' => 'value',
                ]);
            }

            public function render(Block $block): HtmlElement
            {
                return new HtmlElement('div');
            }

            public function supports(Block $block): bool
            {
                return true;
            }
        };
    }

    /**
     * @test
     */
    public function it_returns_class_option(): void
    {
        $blockRenderer = new class() extends GenericBlockRenderer {
            public function __construct()
            {
                parent::__construct([
                    'class' => 'class',
                ]);
            }

            public function render(Block $block): HtmlElement
            {
                if (!$this->hasOption('undefined_option')) {
                    $this->getOption('undefined_option');
                }

                return new HtmlElement('div');
            }

            public function supports(Block $block): bool
            {
                return true;
            }

            public function getClassOptionPublic(): string
            {
                return $this->getClassOption('class');
            }
        };

        self::assertSame('editorjs-class', $blockRenderer->getClassOptionPublic());
    }
}

final class GenericBlock extends Block
{
    public function __construct()
    {
        parent::__construct('id');
    }
}
