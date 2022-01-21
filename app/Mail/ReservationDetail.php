<?php

namespace App\Mail;

use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationDetail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Reservation $reservation)
    {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(ReservationService $reservationService)
    {
        $reservationService->setReservation($this->reservation);
        return $this->from('reservasi@semuwainn.com', 'Semuwainn')
            ->subject('Bukti Pemesanan')
            ->attachData($reservationService->getPDF()->output(), 'reservation-detail.pdf');
    }
}
