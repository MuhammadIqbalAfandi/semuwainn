<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ReservationReportExport;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RoomOrder;
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
            $roomOrder = RoomOrder::whereBetween('order_time', [$startDate, $endDate])->latest();
            if ($roomOrder) {
                return DataTables::of($roomOrder)
                    ->addColumn('order_time', fn(RoomOrder $roomOrder) => $roomOrder->order_time)
                    ->addColumn('room_type', fn(RoomOrder $roomOrder) => $roomOrder->room->roomType->name)
                    ->addColumn('checkin', fn(RoomOrder $roomOrder) => $roomOrder->reservation->checkin)
                    ->addColumn('checkout', fn(RoomOrder $roomOrder) => $roomOrder->reservation->checkout)
                    ->addColumn('night_count', fn(RoomOrder $roomOrder) => view('components.shared.night-count', [
                        'nightCount' => $roomOrder->getNightCount(),
                    ]))
                    ->addColumn('guest_count', fn(RoomOrder $roomOrder) => $roomOrder->guest_count)
                    ->addColumn('price', fn(RoomOrder $roomOrder) => $roomOrder->price)
                    ->make();
            }
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new ReservationReportExport($request), 'reservations-report.xls');
    }
}
