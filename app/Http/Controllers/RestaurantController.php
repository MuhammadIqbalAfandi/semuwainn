<?php

namespace App\Http\Controllers;

use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.restaurant.index');
    }

    public function restaurants()
    {
        $restaurants = Restaurant::all();
        if ($restaurants) {
            return response()->json(
                [
                    'restaurants' => $restaurants,
                ],
                200,
            );
        };
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        Restaurant::create($request->validated());
        return response()->json(
            [
                'message' => 'Hidangan restoran berhasil ditambahkan',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        if ($restaurant) {
            return response()->json(
                [
                    'restaurant' => $restaurant
                ],
                200,
            );
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $restaurant->update($request->validated());
        return response()->json(
            [
                'message' => 'Layanan berhasil diubah',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return response()->json(
            [
                'message' => 'Layanan berhasil dihapus',
                'status' => 'success',
            ],
            200,
        );
    }
}
