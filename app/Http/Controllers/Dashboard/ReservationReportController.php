<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ReservationReportExport;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ReservationReportController extends Controller
{
    public function __construct(private ReservationService $reservationService)
    {}

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('pages.dashboard.report.reservation.index');
    }

    public function reservations(Request $request)
    {
        if ($request->startDate && $request->endDate) {
            $startDate = Carbon::createFromFormat('d/m/Y', $request->startDate)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $request->endDate)->format('Y-m-d');
            $reservation = Reservation::whereBetween('reservation_time', [$startDate, $endDate])->latest();
            if ($reservation) {
                return DataTables::of($reservation)
                    ->addColumn('name', fn(Reservation $reservation) => $reservation->guest->name)
                    ->addColumn('checkin-checkout', fn(Reservation $reservation) => view('components.shared.checkin-checkout', [
                        'checkin' => $reservation->checkin,
                        'checkout' => $reservation->checkout,
                    ]))
                    ->addColumn('night-count', function (Reservation $reservation) {
                        $this->reservationService->setReservation($reservation);
                        $nightCount = $this->reservationService->getNightCount();
                        return view('components.shared.night-count', compact('nightCount'));
                    })
                    ->addColumn('room-count', fn(Reservation $reservation) => $reservation->roomOrders->count())
                    ->addColumn('guest-count', fn(Reservation $reservation) => $reservation->roomOrders->count())
                    ->addColumn('price', function (Reservation $reservation) {
                        $this->reservationService->setReservation($reservation);
                        return $this->reservationService->getTotalBillString();
                    })
                    ->addColumn('status', fn(Reservation $reservation) => view('components.reservation.index.status', [
                        'status' => $reservation->reservationStatus->name,
                    ]))
                    ->make();
            }
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new ReservationReportExport($request), 'reservations-report.xls');
    }
}
