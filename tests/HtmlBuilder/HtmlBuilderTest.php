<?php

declare(strict_types=1);

namespace Setono\EditorJS\HtmlBuilder;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Setono\EditorJS\HtmlBuilder\HtmlBuilder
 */
final class HtmlBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function it_builds(): void
    {
        $builder = HtmlBuilder::create('div')
            ->withClass('container')
            ->append(
                HtmlBuilder::create('div')
                ->withClass('image')
                ->append(
                    HtmlBuilder::create('img')
                    ->withAttribute('src', 'https://example.com/image.jpg')
                    ->withClasses(['img', 'border'])
                )
            )
            ->append(
                HtmlBuilder::create('div')
                ->withClass('caption')
                ->append('Caption')
            )
        ;

        $html = $builder->build();

        self::assertSame('<div class="container"><div class="image"><img src="https://example.com/image.jpg" class="img border"></div><div class="caption">Caption</div></div>', $html);
    }
}
