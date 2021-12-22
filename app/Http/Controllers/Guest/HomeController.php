<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = RoomType::class;
        return inertia('Guest/Home', [
            'rooms' => $rooms::paginate(10)
                ->withQueryString()
                ->through(fn($rooms) => [
                    'id' => $rooms->id,
                    'thumbnail' => [
                        'images' => [],
                        'defaultImage' => '/img/default-room.webp',
                    ],
                    'name' => $rooms->name,
                    'originPrice' => $rooms->roomPrices->max('price'),
                    'facilities' => $rooms->roomFacilities->take(3)->pluck('facility.name'),
                    'facilityCount' => $rooms->roomFacilities->skip(3)->count(),
                    'numberOfGuest' => $rooms->numberOfGuest->guest,
                    'roomAvailable' => $rooms->rooms
                        ->whereNotIn('room_type_id', $rooms->rooms->pluck('roomOrder.room_id'))
                        ->count(),
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
