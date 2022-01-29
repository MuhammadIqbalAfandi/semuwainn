<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use App\Services\ReservationService;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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
    public function download(Reservation $reservation)
    {
        if (Gate::none(['isAdmin', 'isWaiter'])) {
            abort(403);
        }

        $this->reservationService->setReservation($reservation);
        return $this->reservationService->getPDF()->download('reservation-detail.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send(Reservation $reservation)
    {
        if (Gate::none(['isAdmin', 'isWaiter'])) {
            abort(403);
        }

        try {
            Mail::to($reservation->guest->email)->send(new ReservationMail($reservation));

            return back()->with('success', __('messages.success.email.reservation'));
        } catch (Exception $e) {
            return back()->with('failed', __('messages.errors.email.reservation'));
        }
    }
}
