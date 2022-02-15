<?php

namespace App\Traits;

use App\Traits\HelperTrait;
use Illuminate\Support\Collection;

trait RestaurantOrderTrait
{
    use HelperTrait;

    public function getAllTotalPrice(Collection $collects)
    {
        return $collects->sum('price');
    }
}
