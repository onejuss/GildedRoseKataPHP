<?php
declare(strict_types=1);

namespace GildedRose;

class BackstagePassItem implements GildedRoseItem
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function update(): void
    {
        $increase = 1;
        
        $this->item->quality = min(50, $this->item->quality + $increase);

        if ($this->item->sell_in <= 10) {
            $this->item->quality++;
        }

        if ($this->item->sell_in <= 5) {
            $this->item->quality++;
        }

        if ($this->item->quality > 50) {
            $this->item->quality = 50;
        }

        if ($this->item->sell_in <= 0) {
            $this->item->quality = 0;
        }

        $this->item->sell_in--;
    }
}
