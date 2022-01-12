<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationStatus;

class ReservationStatusController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            return response()->json(
                [
                    'reservationId' => $reservation->id,
                    'reservationStatusId' => $reservation->reservation_status_id,
                    'reservationStatuses' => ReservationStatus::all(),
                ],
                200,
            );
        }
        ;
    }
}
