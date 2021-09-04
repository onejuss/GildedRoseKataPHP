<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider dataUpdateQuality
     */
    public function testUpdateQuality(Item $item, array $expected): void
    {
        $items = [$item];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($expected['sell_in'], $items[0]->sell_in);
        $this->assertSame($expected['quality'], $items[0]->quality);
    }

    public function dataUpdateQuality(): array
    {
        return [
            'General item, the value of both items will be one less' => [
                'item' => new Item('Something else', 1, 1),
                'expected' => [
                    'sell_in' => 0,
                    'quality' => 0,
                ],
            ],
            'General item, Quality value will never be negative' => [
                'item' => new Item('Something else', 1, 0),
                'expected' => [
                    'sell_in' => 0,
                    'quality' => 0,
                ],
            ],
            'General items, Quality value will be reduced by 2 when there are no more days left to sell' => [
                'item' => new Item('Something else', 0, 2),
                'expected' => [
                    'sell_in' => -1,
                    'quality' => 0,
                ],
            ],
            'Aged Brie, The Quality value will increase as the days go by.' => [
                'item' => new Item('Aged Brie', 1, 49),
                'expected' => [
                    'sell_in' => 0,
                    'quality' => 50,
                ],
            ],
            'Aged Brie, Quality Value cannot be greater than 50' => [
                'item' => new Item('Aged Brie', 1, 50),
                'expected' => [
                    'sell_in' => 0,
                    'quality' => 50,
                ],
            ],
            'Sulfuras, It will not be sold or its Quality value will be reduced' => [
                'item' => new Item('Sulfuras, Hand of Ragnaros', 1, 80),
                'expected' => [
                    'sell_in' => 1,
                    'quality' => 80,
                ],
            ],
            'Sulfuras, It will not be sold or its Quality value will be reduced (even if it is -1).)' => [
                'item' => new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                'expected' => [
                    'sell_in' => -1,
                    'quality' => 80,
                ],
            ],
            'Backstage pass, SellIn Quality value increases as the value approaches' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 11, 10),
                'expected' => [
                    'sell_in' => 10,
                    'quality' => 11,
                ],
            ],
            'Backstage passes, Within 10 days, it will increase by 2 every day' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10),
                'expected' => [
                    'sell_in' => 9,
                    'quality' => 12,
                ],
            ],
            'Backstage passes, Within 5 days, it will increase by 3 every day' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10),
                'expected' => [
                    'sell_in' => 4,
                    'quality' => 13,
                ],
            ],
            'Backstage passes, It will be 0 after the concert' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10),
                'expected' => [
                    'sell_in' => -1,
                    'quality' => 0,
                ],
            ],
            'Backstage passes, Quality value cannot exceed 50' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 5, 48),
                'expected' => [
                    'sell_in' => 4,
                    'quality' => 50,
                ],
            ],
            'Conjured, The value of both items will be 2 less' => [
                'item' => new Item('Conjured', 1, 2),
                'expected' => [
                    'sell_in' => 0,
                    'quality' => 0,
                ],
            ],
            'Conjured, Quality value will never be negative' => [
                'item' => new Item('Conjured', 1, 0),
                'expected' => [
                    'sell_in' => 0,
                    'quality' => 0,
                ],
            ],
            'Conjured, When there are no more days left to sell, the Quality value will be 4 less.' => [
                'item' => new Item('Conjured', 0, 4),
                'expected' => [
                    'sell_in' => -1,
                    'quality' => 0,
                ],
            ],
        ];
    }
}
