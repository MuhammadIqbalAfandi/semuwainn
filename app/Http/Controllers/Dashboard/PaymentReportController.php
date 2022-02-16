<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('pages.dashboard.report.payment.index');
    }

    public function payments(Request $request)
    {
        if ($request->startDate && $request->endDate) {
            $startDate = Carbon::createFromFormat('d/m/Y', $request->startDate)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $request->endDate)->format('Y-m-d');
            $reservation = Reservation::whereBetween('reservation_time', [$startDate, $endDate])->latest();
            if ($reservation) {
                return DataTables::of($reservation)
                    ->addColumn('date', fn(Reservation $reservation) => $reservation->reservation_time)
                    ->addColumn('income', fn(Reservation $reservation) => $reservation->payment->total)
                    ->addColumn('status', fn(Reservation $reservation) => $reservation->price)
                    ->make();
            }
        }
    }
}
