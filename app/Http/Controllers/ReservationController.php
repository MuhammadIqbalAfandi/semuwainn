<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Guest;
use App\Models\RoomOrder;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReservationStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\StoreReservationServiceRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationStatusRequest;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.reservation.create');
    }

    public function nik(Request $request)
    {
        $response = Guest::where('nik', 'like', "%{$request->search}%")->get(['id', 'nik']);
        return response()->json($response, 200);
    }

    public function rooms()
    {
        $reservationsRoomId = RoomOrder::pluck('room_id');
        $rooms = Room::whereNotIn('id', $reservationsRoomId)->with(['roomType.roomPrices'])->get();
        if ($rooms) {
            return response()->json(
                [
                    'rooms' => $rooms,
                ],
                200,
            );
        }
    }

    public function reservations()
    {
        $reservations = Reservation::with(['roomOrders', 'guest', 'reservationStatus'])->get();
        if ($reservations) {
            return response()->json(
                [
                    'reservations' => $reservations,
                ],
                200,
            );
        }
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
            $reservation = Reservation::create([
                'guest_id' => $request->guest_id,
                'user_id' => auth()->user()->id,
                'reservation_status_id' => 2,
                'reservation_number' => 'OD' . Carbon::now()->format('siHdmy'),
                'adult' => $request->adult,
                'children' => $request->children,
            ]);

            foreach($request->rooms as $index => $room) {
                $reservation->roomOrders()->create([
                    'arrival_date' =>  $request->checkin,
                    'departure_date' => $request->checkout,
                    'user_id' => auth()->user()->id,
                    'room_id' => $request->rooms[$index],
                    'price' => $request->prices[$index],
                    'discount' => $request->discounts[$index],
                    'room_order_status_id' => 1,
                ]);
            }

            DB::commit();

            return response()->json(
                [
                    'message' => 'Pemesanan berhasil ditambahkan',
                    'status' => 'success',
                ],
                201,
            );
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(
                [
                    'message' => 'Pemesanan tidak berhasil ditambahkan',
                    'status' => 'failed'
                ],
                400,
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRoom(Request $request, Reservation $reservation)
    {
        try {
            foreach($request->rooms as $index => $room) {
                $reservation->roomOrders()->create([
                    'arrival_date' =>  $reservation->roomOrders[0]->getRawOriginal('arrival_date'),
                    'departure_date' => $reservation->roomOrders[0]->getRawOriginal('departure_date'),
                    'user_id' => auth()->user()->id,
                    'room_id' => $request->rooms[$index],
                    'price' => $request->prices[$index],
                    'discount' => $request->discounts[$index],
                    'room_order_status_id' => 1,
                ]);
            }
            return response()->json(
                [
                    'message' => 'Kamar berhasil ditambahkan',
                    'status' => 'success',
                ],
                201,
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => 'Kamar tidak berhasil ditambahkan',
                    'status' => 'failed',
                ],
                400,
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function storeService(StoreReservationServiceRequest $request, Reservation $reservation)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRestaurant(Request $request, Reservation $reservation)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $reservation = $reservation->where('id', $reservation->id)->with(['guest', 'roomOrders'])->first();
        if ($reservation) {
            return response()->json(
                [
                    'reservation' => $reservation,
                ],
                200,
            );
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function editStatus(Reservation $reservation)
    {
        $reservationStatuses = ReservationStatus::all();
        if ($reservation) {
            return response()->json(
                [
                    'reservation' => $reservation,
                    'reservationStatuses' => $reservationStatuses,
                ],
                200,
            );
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Reservation  $Reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        DB::beginTransaction();
        try {
            $reservation->update($request->validated());

            foreach ($reservation->roomOrders as $index => $roomOrder) {
                $reservation->roomOrders[$index]->update([
                    'arrival_date' =>  $request->checkin,
                    'departure_date' => $request->checkout,
                ]);
            }

            DB::commit();

            return response()->json(
                [
                    'message' => 'Pemesanan berhasil diubah',
                    'status' => 'success',
                ],
                201,
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'message' => 'Pemesanan tidak berhasil diubah',
                    'status' => 'failed',
                ],
                400,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Reservation  $Reservation
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(UpdateReservationStatusRequest $request, Reservation $reservation)
    {
        $reservation->update($request->validated());
        return response()->json(
            [
                'message' => 'Status pemesanan berhasil diubah',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(
            [
                'message' => 'Fasilitas berhasil dihapus',
                'status' => 'success',
            ],
            200,
        );
    }
}
