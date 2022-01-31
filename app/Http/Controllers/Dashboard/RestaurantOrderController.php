<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RestaurantOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::none(['isAdmin', 'isWaiter'])) {
            abort(403);
        }

        $restaurants = Restaurant::all()->transform(fn($restaurant) => [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'price' => $restaurant->getRawOriginal('price'),
            'quantity' => 0,
        ]);
        return $restaurants;
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
        if (Gate::none(['isAdmin', 'isWaiter'])) {
            abort(403);
        }

        $reservationId = Reservation::find($id)->id;
        if ($reservationId) {
            return view('pages.dashboard.restaurant-order.show', compact('reservationId'));
        }
    }
}
