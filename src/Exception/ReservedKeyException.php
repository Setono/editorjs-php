<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

/**
 * @internal
 */
final class ReservedKeyException extends \RuntimeException implements ParserExceptionInterface
{
    public function __construct(string $key, array $block)
    {
        $json = null;

        try {
            $json = json_encode($block, \JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
        }

        parent::__construct(sprintf(
            "The key '%s' found in data is a reserved key. The inputted block JSON was:\n\n%s",
            $key,
            $json ?? 'Invalid',
        ));
    }
}
