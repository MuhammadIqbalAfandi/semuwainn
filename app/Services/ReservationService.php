<?php

namespace App\Services;

use App\Models\Reservation;
use Illuminate\Support\Carbon;

class ReservationService
{
    private $reservation;

    public function setReservation(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function setRupiahFormat(int $number)
    {
        return 'Rp. ' . number_format($number, '2', ',', '.');
    }

    public function getNightCount()
    {
        return Carbon::parse($this->reservation->getRawOriginal('checkin'))
            ->diffInDays($this->reservation->getRawOriginal('checkout'));
    }

    public function getRoomBill()
    {
        return $this->reservation->roomOrders->sum(function ($roomOrder) {
            return $roomOrder->getRawOriginal('price') * $this->getNightCount();
        });
    }

    public function getServiceBill()
    {
        return $this->reservation->serviceOrders->sum(function ($serviceOrder) {
            return $serviceOrder->getRawOriginal('price') * $serviceOrder->quantity * $this->getNightCount();
        });
    }

    public function getRestaurantBill()
    {
        return $this->reservation->restaurantOrders->sum(function ($restaurant) {
            return $restaurant->getRawOriginal('price') * $restaurant->quantity;
        });
    }

    public function getTotalBill()
    {
        return $this->getRoomBill() + $this->getServiceBill() + $this->getRestaurantBill();
    }

    public function getRestOfBill()
    {
        $totalBill = $this->getTotalBill();
        $payment = $this->reservation->payment->total ?? 0;
        $restOfBill = $this->setRupiahFormat($totalBill - $payment);
        return $restOfBill;
    }

    public function getRoomBillString()
    {
        return $this->setRupiahFormat($this->getRoomBill());
    }

    public function getServiceBillString()
    {
        return $this->setRupiahFormat($this->getServiceBill());
    }

    public function getRestaurantBillString()
    {
        return $this->setRupiahFormat($this->getRestaurantBill());
    }

    public function getTotalBillString()
    {
        return $this->setRupiahFormat($this->getTotalBill());
    }

    public function getPaymentString()
    {
        return $this->setRupiahFormat($this->reservation->payment->total ?? 0);
    }
}
