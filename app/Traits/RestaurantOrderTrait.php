<?php

namespace App\Traits;

use App\Traits\HelperTrait;
use Illuminate\Support\Collection;

trait RestaurantOrderTrait
{
    use HelperTrait;

    public static function getAllTotalPrice(Collection $collects)
    {
        $totalPrice = $collects->sum(function ($collect) {
            return $collect->getRawOriginal('price') * $collect->quantity;
        });

        return self::setRupiahFormat($totalPrice);
    }
}
