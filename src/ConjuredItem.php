<?php

declare(strict_types=1);

namespace GildedRose;

class ConjuredItem extends GeneralItem
{
    public function __construct(Item $item)
    {
        parent::__construct($item);

        $this->decreaseBeforeSellByDate *= 2;
        $this->decreaseAfterSellByDate *= 2;
    }
}
