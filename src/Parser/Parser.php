<?php

declare(strict_types=1);

namespace Setono\EditorJS\Parser;

use Setono\EditorJS\Exception\ParserException;
use Setono\EditorJS\Parser\Block\GenericBlock;
use Setono\EditorJS\Parser\BlockParser\BlockParserInterface;
use Webmozart\Assert\Assert;

final class Parser implements ParserInterface
{
    /** @var list<BlockParserInterface> */
    private array $blockParsers = [];

    public function parse(array $data): Result
    {
        self::validate($data);

        $blockList = new BlockList();

        foreach ($data['blocks'] as $dataBlock) {
            if (!is_array($dataBlock)) {
                throw new ParserException($dataBlock);
            }

            $block = GenericBlock::createFromData($dataBlock);

            foreach ($this->blockParsers as $blockParser) {
                if (!$blockParser->supports($block)) {
                    continue;
                }

                try {
                    $blockList->add($blockParser->parse($block));
                } catch (\Throwable $e) {
                    throw new ParserException($block, $e->getMessage());
                }

                continue 2;
            }

            throw new ParserException($block);
        }

        $time = new \DateTimeImmutable(sprintf('@%d', $data['time']));

        return new Result($time, $data['version'], $blockList);
    }

    public function addBlockParser(BlockParserInterface $blockParser): void
    {
        $this->blockParsers[] = $blockParser;
    }

    /** @psalm-assert array{time: int, version: string, blocks: array<array-key, mixed>} $data */
    private static function validate(array $data): void
    {
        Assert::keyExists($data, 'time');
        Assert::integer($data['time']);

        Assert::keyExists($data, 'version');
        Assert::string($data['version']);

        Assert::keyExists($data, 'blocks');
        Assert::isArray($data['blocks']);
    }
}
