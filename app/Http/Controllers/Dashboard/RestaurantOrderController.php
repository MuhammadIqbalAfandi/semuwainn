<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\RestaurantOrder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RestaurantOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all()->transform(fn($restaurant) => [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'price' => $restaurant->getRawOriginal('price'),
            'quantity' => 0,
        ]);
        return $restaurants;
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
            $restaurants = $request->restaurants;
            $reservation = Reservation::find($id);

            foreach ($restaurants as $restaurant) {
                $price = Restaurant::find($restaurant['id'])->getRawOriginal('price');

                $reservation->restaurantOrders()->create([
                    'restaurant_id' => $restaurant['id'],
                    'quantity' => $restaurant['quantity'],
                    'price' => $price,
                ]);
            }

            return response()->json(
                [
                    'message' => __('messages.success.store.restaurant-order'),
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
            return view('pages.dashboard.restaurant-order.show', compact('reservationId'));
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
    public function destroy(RestaurantOrder $restaurantOrder)
    {
        try {
            $restaurantOrder->delete();
            return response()->json(
                [
                    'message' => __('messages.success.destroy.restaurant-order'),
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
}
