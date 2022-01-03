<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomBooking\StoreRoomBookingRequest;
use App\Models\Guest;
use App\Models\Service;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoomBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia('Guest/RoomBooking/Index', [
            'services' => Service::paginate(10)
                ->withQueryString()
                ->through(fn($services) => [
                    'id' => $services->id,
                    'name' => $services->name,
                    'price' => $services->price,
                    'unit' => $services->unit,
                ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomBookingRequest $request)
    {
        DB::beginTransaction();
        try {
            dd($request);

            $guest = Guest::firstWhere('nik', $request->nik);
            if (!$guest) {
                $guest = Guest::create($request->safe()->except(['checkIn', 'checkOut']));
            }

            $reservation = $guest->reservations()->create([
                'reservation_number' => 'OD' . Carbon::now()->format('YmdHs'),
                'checkin' => $request->checkIn,
                'checkout' => $request->checkOut,
            ]);
            foreach ($request->rooms as $room) {
                $reservation->roomOrders()->create([
                    // FIXME: get price from database
                    'price' => $room['price'],
                    'guest_count' => $room['guestCount'],
                    'quantity' => $room['roomCount'],
                    'room_id' => $room['roomId'],
                ]);

            }
            foreach ($request->services as $service) {
                $reservation->serviceOrders()->create([
                    'price' => $service['price'],
                    'quantity' => $service['roomCount'],
                    'service_id' => $service['id'],
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', __('messages.success.store.room_booking'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('messages.error.store.room_booking'));
        }
    }
}
