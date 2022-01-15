<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomOrder;
use App\Models\Service;
use App\Models\ServiceOrder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        try {
            $id = $request->id;
            $services = $request->services;
            $reservation = Reservation::find($id);

            foreach ($services as $service) {
                $price = Service::find($service['id'])->getRawOriginal('price');

                $reservation->serviceOrders()->create([
                    'service_id' => $service['id'],
                    'quantity' => 1,
                    'price' => $price,
                ]);
            }

            return response()->json(
                [
                    'message' => __('messages.success.store.service-order'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservationId = Reservation::find($id)->id;
        if ($reservationId) {
            return view('pages.dashboard.service-order.show', compact('reservationId'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceId = ServiceOrder::where('reservation_id', $id)->pluck('service_id');
        $services = Service::whereNotIn('id', $serviceId)->get()->transform(fn($service) => [
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->getRawOriginal('price'),
        ]);
        if ($services) {
            return response()->json($services, 200);
        }
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
    public function destroy(ServiceOrder $serviceOrder)
    {
        try {
            $serviceOrder->delete();
            return response()->json(
                [
                    'message' => __('messages.success.destroy.service-order'),
                    'status' => 'success',
                ],
                200,
            );
        } catch (QueryException $e) {
            return response()->json(
                [
                    'message' => __('messages.errors.destroy.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }
    }

    public function rooms($id)
    {
        $roomOrders = RoomOrder::where('reservation_id', $id)->pluck('room_id');
        $rooms = Room::whereIn('id', $roomOrders)->get();
        if ($rooms) {
            return response()->json($rooms, 200);
        }
    }
}
