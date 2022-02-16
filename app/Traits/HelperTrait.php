<?php

namespace App\Traits;

trait HelperTrait
{
    public static function setRupiahFormat(int $number)
    {
        return 'Rp. ' . number_format($number, '2', ',', '.');
    }
}
