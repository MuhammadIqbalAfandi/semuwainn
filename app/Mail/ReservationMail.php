<?php

namespace App\Mail;

use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private Reservation $reservation)
    {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(ReservationService $reservationService)
    {
        $reservationService->setReservation($this->reservation);
        return $this->subject('Bukti Pemesanan')
            ->view('mail.dashboard.reservation.index')
            ->attachData($reservationService->getPDF()->output(), 'reservation-detail.pdf');
    }
}
