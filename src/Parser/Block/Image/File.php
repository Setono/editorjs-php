<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser\Block\Image;

use Webmozart\Assert\Assert;

final class File
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public static function createFromData(array $data): self
    {
        Assert::keyExists($data, 'url');
        Assert::string($data['url']);

        return new self($data['url']);
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
