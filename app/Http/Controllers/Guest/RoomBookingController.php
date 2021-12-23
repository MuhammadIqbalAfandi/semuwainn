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
            dd($request);
            $guest = Guest::create($request);
            $reservation = $guest->reservations->create([
                'reservation_number' => 'OD' . Carbon::now()->format('ssmmHHDDMMY'),
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
            ]);
            $request->get('rooms')->each(function ($room) use ($reservation) {
                $reservation->roomOrders->create([
                    'price' => $room->price,
                    'guest_count' => $room->guestCount,
                    'quantity' => $room->roomCount,
                    'room_id' => $room->id,
                ]);
            });
            $request->get('services')->each(function ($service) use ($reservation) {
                $reservation->serviceOrders->create([
                    'price' => $service->price,
                    'quantity' => $service->roomCount,
                    'service_id' => $service->id,
                ]);
            });

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
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
