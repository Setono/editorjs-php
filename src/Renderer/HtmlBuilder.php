<?php

declare(strict_types=1);

namespace Setono\EditorJS\Renderer;

// todo extract into library
use Webmozart\Assert\Assert;

final class HtmlBuilder
{
    private string $tag;

    // found here: https://www.thoughtco.com/html-singleton-tags-3468620
    public const TAGS_WITH_NO_CLOSING_TAG = [
        'area', 'base', 'br', 'col', 'command', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr',
    ];

    private bool $closingTag = true;

    /** @var array<string, array<array-key, string|null>> */
    private array $attributes = [];

    /** @var array<array-key, string> */
    private array $children = [];

    public function __construct(string $tag)
    {
        $this->tag = strtolower($tag);

        if (in_array($this->tag, self::TAGS_WITH_NO_CLOSING_TAG, true)) {
            $this->closingTag = false;
        }
    }

    public function __toString(): string
    {
        return $this->build();
    }

    public static function create(string $tag): self
    {
        return new self($tag);
    }

    public function withClass(string $class): self
    {
        return $this->withAttribute('class', $class);
    }

    /**
     * @param array<array-key, string> $classes
     */
    public function withClasses(array $classes): self
    {
        $new = clone $this;
        foreach ($classes as $class) {
            $new = $new->withClass($class);
        }

        return $new;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function withAttribute(string $attribute, $value = null): self
    {
        Assert::scalar($value);

        $new = clone $this;
        if (!isset($new->attributes[$attribute])) {
            $new->attributes[$attribute] = [];
        }

        $new->attributes[$attribute][] = (string) $value;

        return $new;
    }

    /**
     * @param HtmlBuilder|scalar $children
     */
    public function append(...$children): self
    {
        if (!$this->closingTag) {
            throw new \RuntimeException(sprintf('You are trying to append data to an empty HTML tag (%s)', $this->tag));
        }

        $new = clone $this;

        foreach ($children as $child) {
            $new->children[] = (string) $child;
        }

        return $new;
    }

    public function noClosingTag(): self
    {
        $new = clone $this;
        $new->closingTag = false;

        return $new;
    }

    public function build(): string
    {
        $html = sprintf('<%s', $this->tag);

        $attributeString = '';

        foreach ($this->attributes as $attribute => $values) {
            $valueString = implode(' ', $values);
            $attributeString .= sprintf(' %s', $attribute);

            if ('' !== $valueString) {
                $attributeString .= sprintf('="%s"', $valueString);
            }
        }
        $html .= sprintf('%s>', $attributeString);

        foreach ($this->children as $child) {
            $html .= $child;
        }

        if ($this->closingTag) {
            $html .= sprintf('</%s>', $this->tag);
        }

        return $html;
    }
}
