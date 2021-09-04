<?php

declare(strict_types=1);

namespace GildedRose;

class AgedItem implements GildedRoseItem
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function update(): void
    {
        $increase = 1;
        if ($this->item->sell_in <= 0) {
            $increase = 2;
        }
        $this->item->quality = min(50, $this->item->quality + $increase);
        $this->item->sell_in--;
    }
}

?>