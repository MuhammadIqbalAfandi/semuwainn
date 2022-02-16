<?php

namespace App\Traits;

use App\Traits\HelperTrait;
use Illuminate\Support\Collection;

trait ServiceOrderTrait
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
