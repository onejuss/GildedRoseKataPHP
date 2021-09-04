<?php

declare(strict_types=1);

namespace GildedRose;

class GeneralItem implements GildedRoseItem
{
    protected int $decreaseBeforeSellByDate = 1;
    protected int $decreaseAfterSellByDate = 2;

    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function update(): void
    {
        $decrease = $this->decreaseBeforeSellByDate;
        if ($this->item->sell_in <= 0) {
            $decrease = $this->decreaseAfterSellByDate;
        }
        $this->item->quality = max(0, $this->item->quality - $decrease);
        $this->item->sell_in--;
    }
}