<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomDetailController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roomType = RoomType::find($id);
        return inertia('Guest/RoomDetail', [
            'room' => [
                'id' => $roomType->id,
                'name' => $roomType->name,
                'thumbnail' => [
                    'images' => [],
                    'defaultImage' => '/img/default-room.webp',
                ],
                'numberOfGuest' => $roomType->numberOfGuest->guest,
                'priceRange' => [
                    'minPrice' => $roomType->roomPrices->min('price'),
                    'maxPrice' => $roomType->roomPrices->max('price'),
                ],
                'facilities' => $roomType->roomFacilities->pluck('facility.name'),
                'roomAvailable' => $roomType->rooms
                    ->whereNotIn('room_type_id', $roomType->rooms->pluck('roomOrder.room_id'))
                    ->count(),
                'prices' => $roomType->roomPrices->transform(fn($roomPrice) => [
                    'id' => $roomPrice->id,
                    'description' => $roomPrice->description,
                    'price' => $roomPrice->price,
                ]),
            ],
        ]);
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
