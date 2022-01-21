<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;

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
        return $this->reservationService->getPDF()->download('reservation-detail.pdf');
    }
}
