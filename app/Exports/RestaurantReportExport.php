<?php

namespace App\Exports;

use App\Models\RestaurantOrder;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestaurantReportExport implements FromView, WithStyles, ShouldAutoSize
{
    public function __construct(private Request $request)
    {}

    public function view(): View
    {
        $startDate = Carbon::createFromFormat('d/m/Y', $this->request->startDate)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d/m/Y', $this->request->endDate)->format('Y-m-d');
        $restaurantOrders = RestaurantOrder::whereBetween('order_time', [$startDate, $endDate])->get();

        return view('components.report.excel', [
            'restaurantOrders' => $restaurantOrders,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $rowTotal = $sheet->getHighestDataRow();

        $sheet->getRowDimension($rowTotal)->setRowHeight(16);

        return [
            1 => ['font' => ['bold' => true]],
            $rowTotal => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
