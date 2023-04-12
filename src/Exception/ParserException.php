<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Tree\Message\Messages;
use Psl\Type\Exception\AssertException;
use Setono\EditorJS\Block\Block;
use Setono\EditorJS\Parser\Parser;

/**
 * @internal
 */
final class ParserException extends \RuntimeException implements ExceptionInterface
{
    public ?string $json = null;

    public static function invalidJson(string $json, \JsonException $e): self
    {
        $new = new self(sprintf(
            'You have an error in your JSON. The error was: %s. You can access the supplied JSON in the %s property',
            $e->getMessage(),
            self::class . '$json',
        ), 0, $e);

        $new->json = $json;

        return $new;
    }

    public static function invalidData(string $json, AssertException $e): self
    {
        $new = new self(sprintf(
            'You have an error in the supplied data. The error was: %s. You can access the supplied JSON in the %s property',
            $e->getMessage(),
            self::class . '$json',
        ), 0, $e);

        $new->json = $json;

        return $new;
    }

    public static function unmappedType(string $type): self
    {
        return new self(sprintf(
            'The block type "%s" was not mapped to any class. Did you forget to add the type to the mapping for this particular type? You can use %s',
            $type,
            Parser::class . '::setMapping()',
        ));
    }

    /**
     * @param array{id: string, type: string, data: array} $block
     */
    public static function reservedKey(string $key, array $block): self
    {
        $json = null;

        try {
            $json = json_encode($block, \JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
        }

        return new self(sprintf(
            "The key '%s' found in data is a reserved key. The inputted block JSON was:\n\n%s",
            $key,
            $json ?? 'Invalid',
        ));
    }

    /**
     * @param class-string<Block> $mapping
     */
    public static function mappingError(MappingError $e, string $type, string $mapping): self
    {
        $errorMessage = $e->getMessage() . "\n\n";

        $messages = Messages::flattenFromNode($e->node())->errors();
        foreach ($messages as $message) {
            $errorMessage .= $message . "\n";
        }

        return new self(sprintf(
            'The block type "%s" could not be mapped to the class "%s". The error was: %s',
            $type,
            $mapping,
            $errorMessage,
        ), 0, $e);
    }
}
