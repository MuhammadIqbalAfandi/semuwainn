<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ServiceReportExport;
use App\Http\Controllers\Controller;
use App\Models\ServiceOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ServiceReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('pages.dashboard.report.service.index');
    }

    public function services(Request $request)
    {
        if ($request->startDate && $request->endDate) {
            $startDate = Carbon::createFromFormat('d/m/Y', $request->startDate)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $request->endDate)->format('Y-m-d');
            $serviceOrder = ServiceOrder::whereBetween('order_time', [$startDate, $endDate])->latest();
            if ($serviceOrder) {
                return DataTables::of($serviceOrder)
                    ->addColumn('order_time', fn(ServiceOrder $serviceOrder) => $serviceOrder->order_time)
                    ->addColumn('service_name', fn(ServiceOrder $serviceOrder) => $serviceOrder->service->name)
                    ->addColumn('price', fn(ServiceOrder $serviceOrder) => $serviceOrder->price)
                    ->make();
            }
        }

    }

    public function export(Request $request)
    {
        return Excel::download(new ServiceReportExport($request), 'restaurants-report.xls');
    }
}
