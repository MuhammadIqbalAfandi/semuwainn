<?php

namespace App\Exports;

use App\Models\Reservation;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReservationReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function __construct(private Request $request)
    {}

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $startDate = Carbon::createFromFormat('d/m/Y', $this->request->startDate)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d/m/Y', $this->request->endDate)->format('Y-m-d');
        $reservation = Reservation::whereBetween('reservation_time', [$startDate, $endDate])->get();

        return $reservation;
    }

    public function headings(): array
    {
        return [
            'Nama Tamu',
            'Tanggal Pemesanan',
            'Tanggal Checkin',
            'Tanggal Checkout',
            'Lama Inap',
            'Jumlah Ruangan dipesan',
            'Nama Ruangan',
            'Status',
            'Total Harga',
        ];
    }

    public function map($reservation): array
    {
        $reservationService = new ReservationService;
        $reservationService->setReservation($reservation);

        return [
            $reservation->guest->name,
            $reservation->reservation_time,
            $reservation->checkin,
            $reservation->checkout,
            $reservationService->getNightCountString(),
            $reservation->rooms->count(),
            $reservationService->getRooms(),
            $reservation->reservationStatus->name,
            $reservationService->getTotalBillString(),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
