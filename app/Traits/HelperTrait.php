<?php

namespace App\Traits;

trait HelperTrait
{
    public function setRupiahFormat(int $number)
    {
        return 'Rp. ' . number_format($number, '2', ',', '.');
    }
}
