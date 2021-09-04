<?php

declare(strict_types=1);

namespace GildedRose;

class ItemFactory
{
    public function factory(Item $item): GildedRoseItem
    {
        if ($item->name === 'Aged Brie') {
            return new AgedItem($item);
        }
        if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
            return new BackstagePassItem($item);
        }
        if ($item->name === 'Sulfuras, Hand of Ragnaros') {
            return new LegendaryItem($item);
        }
        if ($item->name === 'Conjured') {
            return new ConjuredItem($item);
        }
        return new GeneralItem($item);
    }
}
