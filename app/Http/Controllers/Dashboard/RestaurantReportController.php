<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\RestaurantReportExport;
use App\Http\Controllers\Controller;
use App\Models\RestaurantOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class RestaurantReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('pages.dashboard.report.restaurant.index');
    }

    public function restaurants(Request $request)
    {
        if ($request->startDate && $request->endDate) {
            $startDate = Carbon::createFromFormat('d/m/Y', $request->startDate)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $request->endDate)->format('Y-m-d');
            $restaurantOrder = RestaurantOrder::whereBetween('order_time', [$startDate, $endDate])->latest();
            if ($restaurantOrder) {
                return DataTables::of($restaurantOrder)
                    ->addColumn('order_time', fn(RestaurantOrder $restaurantOrder) => $restaurantOrder->order_time)
                    ->addColumn('restaurant_name', fn(RestaurantOrder $restaurantOrder) => $restaurantOrder->restaurant->name)
                    ->addColumn('quantity', fn(RestaurantOrder $restaurantOrder) => $restaurantOrder->quantity)
                    ->addColumn('unit', fn(RestaurantOrder $restaurantOrder) => $restaurantOrder->price)
                    ->addColumn('price', fn(RestaurantOrder $restaurantOrder) => $restaurantOrder->totalPrice())
                    ->make();
            }
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new RestaurantReportExport($request), 'restaurants-report.xls');
    }
}
