<?php

declare(strict_types=1);

namespace Mcbeany\Spyglass\item;

use pocketmine\item\Item;

class Spyglass extends Item
{

    public const SPYGLASS = 772;

    public function __construct(int $meta = 0)
    {
        parent::__construct(self::SPYGLASS, $meta, "Spyglass");
    }

    public function getMaxStackSize(): int
    {
        return 1;
    }

}
