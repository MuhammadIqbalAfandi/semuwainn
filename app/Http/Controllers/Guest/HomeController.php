<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\RoomType;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia('Guest/Home/Index', [
            'rooms' => RoomType::filter()
                ->paginate(10)
                ->withQueryString()
                ->through(fn($roomType) => [
                    'id' => $roomType->id,
                    'thumbnail' => [
                        'images' => [],
                        'defaultImage' => '/img/default-room.webp',
                    ],
                    'name' => $roomType->name,
                    'price' => $roomType->roomPrices->min('price'),
                    'facilities' => $roomType->roomFacilities->take(3)->pluck('facility.name'),
                    'facilityCount' => $roomType->roomFacilities->skip(3)->count(),
                    'numberOfGuest' => $roomType->numberOfGuest->guest,
                    'roomsId' => $roomType->rooms->whereNotIn('id', $roomType->roomOrders->pluck('room_id'))->pluck('id'),
                ]),
        ]);
    }
}
