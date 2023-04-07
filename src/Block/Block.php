<?php

declare(strict_types=1);

namespace Setono\EditorJS\Block;

/**
 * All blocks must inherit from this class
 */
class Block
{
    /**
     * This is the unique id of the block, typically it looks something like this: GGt5HAoo0w
     */
    public string $id;

    /**
     * This is the type of the block, this could be 'header', 'embed', 'delimiter' etc.
     */
    public string $type;

    /**
     * This holds the block specific data, for an embed block it could look like this:
     *
     * [
     *   "service": "youtube",
     *   "source": "https://www.youtube.com/watch?v=MxexAd0k44U",
     *   "embed": "https://www.youtube.com/embed/MxexAd0k44U",
     *   "width": 580,
     *   "height": 320,
     *   "caption": ""
     * ]
     *
     * @var array<string, mixed>
     */
    public array $data;

    /**
     * The Block classes should be dynamically instantiable, hence we can't have constructor arguments in child classes
     *
     * @param array<string, mixed> $data
     */
    final public function __construct(string $id, string $type, array $data)
    {
        $this->id = $id;
        $this->type = $type;
        $this->data = $data;
    }
}
