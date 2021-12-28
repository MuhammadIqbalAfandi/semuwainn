<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomBooking\StoreRoomBookingRequest;
use App\Models\Guest;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
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
        return inertia('Guest/RoomBooking', [
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $request = $request->collect();

            $guest = Guest::firstOrCreate([
                'nik' => $request->get('nik'),
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
            ]);
            $reservation = $guest->reservations()->create([
                'reservation_number' => 'OD' . Carbon::now()->format('YmdHs'),
                'checkin' => $request->get('checkIn'),
                'checkout' => $request->get('checkOut'),
            ]);
            foreach ($request->get('rooms') as $room) {
                foreach ($room['roomId'] as $roomId) {
                    $reservation->roomOrders()->create([
                        'price' => $room['price'],
                        'guest_count' => $room['guestCount'],
                        'quantity' => $room['roomCount'],
                        'room_id' => $roomId,
                    ]);
                }
            }
            foreach ($request->get('services') as $service) {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
