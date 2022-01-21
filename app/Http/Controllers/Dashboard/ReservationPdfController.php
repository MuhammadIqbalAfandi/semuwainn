<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;
use PDF;

class ReservationPdfController extends Controller
{
    public function __construct(private ReservationService $reservationService)
    {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $this->reservationService->setReservation($reservation);
        $nightCount = $this->reservationService->getNightCount();
        $roomBillString = $this->reservationService->getRoomBillString();
        $serviceBillString = $this->reservationService->getServiceBillString();
        $restaurantBillString = $this->reservationService->getRestaurantBillString();

        switch ($reservation->reservation_status_id) {
            case 1:
            case 4:
            case 5:
                $restOfBill = $this->reservationService->getRestOfBill();
                $payment = $this->reservationService->getPaymentString();
                break;
            default:
                $restOfBill = $this->reservationService->getTotalBillString();
                $payment = 0;
        }

        $pdf = PDF::loadView('pdf.reservation-pdf.show', compact(
            'reservation',
            'nightCount',
            'restOfBill',
            'payment',
            'roomBillString',
            'serviceBillString',
            'restaurantBillString',
        ));
        return $pdf->download('reservation-detail.pdf');
    }
}
