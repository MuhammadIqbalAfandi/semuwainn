<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\RoomType;

class HomeController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return inertia('Guest/Home/Index', [
            'roomTypes' => RoomType::filter()
                ->latest()
                ->paginate(10)
                ->withQueryString()
                ->through(fn($roomType) => [
                    'id' => $roomType->id,
                    'thumbnail' => $roomType->thumbnail
                    ? asset('storage/thumbnails/' . $roomType->thumbnail->file_name)
                    : asset('img/default-room.webp'),
                    'name' => $roomType->name,
                    'price' => $roomType->roomPrices->min()->getRawOriginal('price'),
                    'facilities' => $roomType->roomFacilities->take(3)->pluck('facility.name'),
                    'facilityCount' => $roomType->roomFacilities->skip(3)->count(),
                    'numberOfGuest' => $roomType->number_of_guest,
                    'roomsId' => $roomType->rooms->whereNotIn('id', $roomType->roomOrders->pluck('room_id'))->pluck('id'),
                ]),
        ]);

    }
}
