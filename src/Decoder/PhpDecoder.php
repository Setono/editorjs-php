<?php

declare(strict_types=1);

namespace Setono\EditorJS\Decoder;

use Webmozart\Assert\Assert;

final class PhpDecoder implements DecoderInterface
{
    public function decode(string $data): array
    {
        $result = json_decode($data, true, 512, \JSON_THROW_ON_ERROR);
        Assert::isArray($result);

        return $result;
    }
}
