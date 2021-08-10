<?php

declare(strict_types=1);

namespace Setono\EditorJS\Exception;

use Setono\EditorJS\Parser\Block\BlockInterface;

final class ParserException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @param mixed|BlockInterface $block
     */
    public function __construct($block, string $additionalInfo = null)
    {
        $message = 'Could not parse block.';

        if ($block instanceof BlockInterface) {
            $message = sprintf('Could not parse block "%s" (id: %s).', $block->getType(), $block->getId());
        }

        if (is_string($block)) {
            $message = sprintf('Could not parse block. Input was %s.', $block);
        }

        if (null !== $additionalInfo) {
            $message .= ' ' . $additionalInfo;
        }

        parent::__construct($message);
    }
}
