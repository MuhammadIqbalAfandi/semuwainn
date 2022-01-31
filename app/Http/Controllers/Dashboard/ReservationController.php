<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Models\Reservation;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class ReservationController extends Controller
{
    public function __construct(private ReservationService $reservationService)
    {}

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
        if (Gate::none(['isAdmin', 'isWaiter'])) {
            abort(403);
        }

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

        return view('pages.dashboard.reservation.show',
            compact(
                'reservation',
                'nightCount',
                'restOfBill',
                'payment',
                'roomBillString',
                'serviceBillString',
                'restaurantBillString',
            ),
        );
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
        DB::beginTransaction();
        try {
            $reservation->update([
                'user_id' => $request->user()->id,
                'reservation_status_id' => $request->reservation_status_id,
            ]);

            $this->reservationService->setReservation($reservation);
            switch ($request->reservation_status_id) {
                case 1:
                case 4:
                    if (!$reservation->payment()->exists()) {
                        $reservation->payment()->create([
                            'total' => $this->reservationService->getTotalBill(),
                        ]);
                    }
                    break;
                case 5:
                    $reservation->payment()->delete();
                    $reservation->payment()->create([
                        'total' => $this->reservationService->getTotalBill(),
                    ]);
                    break;
            }

            DB::commit();

            return response()->json(
                [
                    'message' => __('messages.success.update.reservation-status'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            DB::rollBack();

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
                ->filterColumn('order', function ($reservation, $keyword) {
                    $reservation->whereHas('guest', function ($query) use ($keyword) {
                        $query->where('nik', 'like', "%{$keyword}%");
                    })
                        ->orWhere('reservation_number', 'like', "%{$keyword}%")
                        ->orWhere('reservation_time', 'like', "%{$keyword}%");
                })
                ->filterColumn('status', function ($reservation, $keyword) {
                    $reservation->whereHas('reservationStatus', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->addColumn('order', function (Reservation $reservation) {
                    return view('components.reservation.index.order-date',
                        [
                            'id' => $reservation->id,
                            'reservation_number' => $reservation->reservation_number,
                            'reservation_time' => $reservation->reservation_time,
                            'nik' => $reservation->guest->nik,
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
                    $id = $reservation->id;
                    $statusHide = !in_array($reservation->reservation_status_id, [3, 5]);
                    return view('components.reservation.index.action-btn', compact('id', 'statusHide'));
                })
                ->make(true);
        }
    }
}
