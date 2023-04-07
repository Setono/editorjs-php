<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\Mapper\Tree\Message\Messages;
use CuyZ\Valinor\MapperBuilder;

final class Parser implements ParserInterface
{
    public function parse(string $json): ParserResult
    {
        try {
            return (new MapperBuilder())
                ->allowPermissiveTypes()
                ->registerConstructor(function (int $time): \DateTimeImmutable {
                    return new \DateTimeImmutable(sprintf('@%d', (int) ($time / 1000))); // the time from EditorJS is in milliseconds
                })
                ->mapper()
                ->map(ParserResult::class, Source::json($json))
            ;
        } catch (MappingError $error) {
            echo $error->getMessage() . "\n";

            $messages = Messages::flattenFromNode($error->node());

            // If only errors are wanted, they can be filtered
            $errorMessages = $messages->errors();

            foreach ($errorMessages as $message) {
                echo $message . "\n";
            }
        }

        throw new \LogicException('');
    }
}
