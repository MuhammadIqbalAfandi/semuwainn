<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Restaurant;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Http\Request;

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
        return view(
            'pages.dashboard.dashboard.index',
            compact(
                'roomTypeCount',
                'roomCount',
                'serviceCount',
                'restaurantCount',
                'guestCount',
            )
        );
    }
}
