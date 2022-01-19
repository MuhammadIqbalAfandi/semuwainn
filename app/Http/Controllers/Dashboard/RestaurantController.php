<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Models\RestaurantOrder;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

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
        try {
            Restaurant::create($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.store.restaurant'),
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
                    'name' => $restaurant->name,
                    'unit' => $restaurant->unit,
                    'price' => $restaurant->getRawOriginal('price'),
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
        try {
            $restaurant->update($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.update.restaurant'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $th) {
            return response()->json(
                [
                    'message' => __('messages.errors.update.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }
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
                    'message' => __('messages.errors.destroy.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }
    }

    public function restaurants()
    {
        $restaurant = Restaurant::latest();
        if ($restaurant) {
            return DataTables::of($restaurant)
                ->addColumn('actions', function (Restaurant $restaurant) {
                    return view('components.shared.action-btn',
                        [
                            'id' => $restaurant->id,
                            'btnDeleteHide' => !RestaurantOrder::where('restaurant_id', $restaurant->id)->first(),
                        ]);
                })
                ->make(true);
        };
    }
}
