<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Database\QueryException;

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
                'message' => __('messages.success.store.restaurant'),
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
                    'restaurant' => $restaurant,
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
                'message' => __('messages.success.update.restaurant'),
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
        try {
            $restaurant->delete();
            return response()->json(
                [
                    'message' => __('messages.success.destroy.restaurant'),
                    'status' => 'success',
                ],
                200,
            );

        } catch (QueryException $e) {
            return response()->json(
                [
                    'message' => __('messages.error.destroy.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }

    }

    public function restaurants()
    {
        $restaurants = Restaurant::latest()->paginate(10);
        if ($restaurants) {
            return response()->json($restaurants, 200);
        };
    }
}
