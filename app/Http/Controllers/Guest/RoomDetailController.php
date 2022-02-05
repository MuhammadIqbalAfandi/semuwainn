<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\RoomType;

class RoomDetailController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roomType = RoomType::find($id);
        return inertia('Guest/RoomDetail/Index', [
            'roomType' => [
                'id' => $roomType->id,
                'name' => $roomType->name,
                'thumbnails' => [
                    'images' => $roomType->thumbnails()->exists()
                    ? $roomType->thumbnails->transform(fn($thumbnail) => [
                        asset('storage/thumbnails/' . $thumbnail->file_name),
                    ])
                    : [],
                    'defaultImage' => '/img/default-room.webp',
                ],
                'numberOfGuest' => $roomType->number_of_guest,
                'priceRange' => [
                    'minPrice' => $roomType->roomPrices->min()->getRawOriginal('price'),
                    'maxPrice' => $roomType->roomPrices->max()->getRawOriginal('price'),
                ],
                'facilities' => $roomType->roomFacilities->pluck('facility.name'),
                'roomsId' => $roomType->rooms->whereNotIn('id', $roomType->roomOrders->pluck('room_id'))->pluck('id'),
                'prices' => $roomType->roomPrices->transform(fn($roomPrice) => [
                    'id' => $roomPrice->id,
                    'description' => $roomPrice->description,
                    'price' => $roomPrice->getRawOriginal('price'),
                ]),
            ],
        ]);
    }
}
