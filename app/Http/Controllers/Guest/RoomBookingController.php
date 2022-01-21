<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomBooking\StoreRoomBookingRequest;
use App\Mail\ReservationDetail;
use App\Models\Guest;
use App\Models\RoomPrice;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            'services' => Service::latest()
                ->paginate(10)
                ->withQueryString()
                ->through(fn($services) => [
                    'id' => $services->id,
                    'name' => $services->name,
                    'price' => $services->getRawOriginal('price'),
                    'unit' => $services->serviceUnit->name,
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
                    'price' => RoomPrice::find($room['priceId'])->getRawOriginal('price'),
                    'guest_count' => $room['guestCount'],
                    'room_id' => $room['id'],
                ]);
            }
            foreach ($request->services as $service) {
                $reservation->serviceOrders()->create([
                    'price' => Service::find($service['id'])->getRawOriginal('price'),
                    'quantity' => $service['roomCount'],
                    'service_id' => $service['id'],
                ]);
            }

            Mail::to($request->mail)->send(new ReservationDetail($reservation));

            DB::commit();
            return redirect()->back()->with('success', __('messages.success.store.room_booking'));
        } catch (QueryException $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', __('messages.errors.store.all'));
        }
    }
}
