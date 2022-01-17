<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Models\Guest;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.reservation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation $reservation
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

        return view('pages.dashboard.reservation.show',
            compact(
                'reservation',
                'nightCount',
                'totalPrice',
                'totalRoomPriceString',
                'totalServicePriceString',
                'totalRestaurantPriceString',
            ),
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        DB::beginTransaction();
        try {
            DB::commit();

            return response()->json(
                [
                    'message' => __('messages.success.store.reservation'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            DB::rollback();

            return response()->json(
                [
                    'message' => __('messages.errors.store.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        try {
            $reservation->update([
                'user_id' => auth()->user()->id,
                'reservation_status_id' => $request->reservation_status_id,
            ]);
            return response()->json(
                [
                    'message' => __('messages.success.update.reservation-status'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            return response()->json(
                [
                    'message' => __('messages.errors.update.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }
    }

    public function reservations()
    {
        $reservation = Reservation::with(['roomOrders', 'guest', 'reservationStatus'])->latest();
        if ($reservation) {
            return DataTables::of($reservation)
                ->addColumn('order', function (Reservation $reservation) {
                    return view('components.reservation.index.order-date',
                        [
                            'id' => $reservation->id,
                            'reservation_number' => $reservation->reservation_number,
                            'reservation_time' => $reservation->getRawOriginal('reservation_time'),
                        ]);
                })
                ->addColumn('checkin-checkout', function (Reservation $reservation) {
                    return view('components.reservation.index.checkin-checkout',
                        [
                            'checkin' => $reservation->checkin,
                            'checkout' => $reservation->checkout,
                        ]);
                })
                ->addColumn('night-count', function (Reservation $reservation) {
                    $nightCount = Carbon::parse($reservation->getRawOriginal('checkin'))->diffInDays($reservation->getRawOriginal('checkout'));
                    return view('components.reservation.index.night-count', compact('nightCount'));
                })
                ->addColumn('room-count', fn(Reservation $reservation) => $reservation->roomOrders->count())
                ->addColumn('guest-count', fn(Reservation $reservation) => $reservation->roomOrders->count())
                ->addColumn('status', function (Reservation $reservation) {
                    return view('components.reservation.index.status',
                        [
                            'status' => $reservation->reservationStatus->name,
                        ]);
                })
                ->addColumn('actions', function (Reservation $reservation) {
                    return view('components.reservation.index.action-btn', ['id' => $reservation->id]);
                })
                ->make(true);
        }
    }

    public function nik(Request $request)
    {
        $response = Guest::where('nik', 'like', "%{$request->search}%")->get(['id', 'nik']);
        return response()->json($response, 200);
    }
}
