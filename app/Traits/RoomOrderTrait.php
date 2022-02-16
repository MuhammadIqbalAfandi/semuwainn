<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait RoomOrderTrait
{
    use HelperTrait;

    public static function getAllTotalPrice(Collection $collects)
    {
        $totalPrice = $collects->sum(function ($collect) {
            return $collect->getRawOriginal('price');
        });

        return self::setRupiahFormat($totalPrice);
    }
}
