<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use PDF;

class ReservationPdfController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $nightCount = Carbon::parse($reservation->getRawOriginal('checkin'))
            ->diffInDays($reservation->getRawOriginal('checkout'));
        $totalRoomPrice = $reservation->roomOrders->sum(function ($roomOrder) {
            return $roomOrder->getRawOriginal('price') * $roomOrder->quantity;
        });
        $totalServicePrice = $reservation->serviceOrders->sum(function ($serviceOrder) use ($nightCount) {
            return $serviceOrder->getRawOriginal('price') * $serviceOrder->quantity * $nightCount;
        });
        $totalRestaurantPrice = $reservation->restaurantOrders->sum(function ($restaurantOrder) {
            return $restaurantOrder->getRawOriginal('price') * $restaurantOrder->quantity;
        });
        $totalPrice = 'Rp. ' . number_format(($totalRoomPrice + $totalServicePrice + $totalRestaurantPrice), '2', ',', '.');

        $totalRoomPriceString = 'Rp. ' . number_format($totalRoomPrice, '2', ',', '.');
        $totalServicePriceString = 'Rp. ' . number_format($totalServicePrice, '2', ',', '.');
        $totalRestaurantPriceString = 'Rp. ' . number_format($totalRestaurantPrice, '2', ',', '.');

        $pdf = PDF::loadView('pdf.reservation-pdf.show', compact(
            'reservation',
            'nightCount',
            'totalPrice',
            'totalRoomPriceString',
            'totalServicePriceString',
            'totalRestaurantPriceString',
        ));
        return $pdf->download('reservation-detail.pdf');
    }
}
