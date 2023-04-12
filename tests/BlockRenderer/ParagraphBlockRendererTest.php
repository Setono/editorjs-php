<?php

declare(strict_types=1);

namespace Setono\EditorJS\BlockRenderer;

use Setono\EditorJS\Block\ParagraphBlock;

final class ParagraphBlockRendererTest extends BlockRendererTestCase
{
    protected function getData(): iterable
    {
        yield [
            new ParagraphBlock('PqqMsdfbm', 'Paragraph'),
            '<p>Paragraph</p>',
        ];
    }

    protected function getBlockRenderer(): BlockRendererInterface
    {
        return new ParagraphBlockRenderer();
    }
}
