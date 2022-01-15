<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Restaurant;
use App\Models\Room;
use App\Models\RoomOrder;
use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $roomTypeCount = RoomType::count();
        $roomCount = Room::count();
        $serviceCount = Service::count();
        $restaurantCount = Restaurant::count();
        $guestCount = Guest::count();
        $remainingRoom = Room::whereNotIn('id', RoomOrder::pluck('room_id'))->count();
        return view(
            'pages.dashboard.dashboard.index',
            compact(
                'roomTypeCount',
                'roomCount',
                'serviceCount',
                'restaurantCount',
                'guestCount',
                'remainingRoom',
            )
        );
    }

    public function chartData()
    {
        $roomOrders = RoomOrder::all();
        if ($roomOrders) {
            $group = $roomOrders->groupBy(function ($roomOrder) {
                return Carbon::parse($roomOrder->created_at)->format('M-Y');
            });
            return response()->json($group, 200);
        }
    }
}
