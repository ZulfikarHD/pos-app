<?php

namespace App\Exports;

use App\Models\Revenue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RevenueExport implements FromCollection, WithHeadings
{
    protected $revenues;

    public function __construct($revenues)
    {
        $this->revenues = $revenues;
    }

    public function collection()
    {
        return $this->revenues->map(function ($revenue) {
            return [
                'Date' => $revenue->revenue_date->format('Y-m-d'),
                'Amount' => $revenue->amount,
                'Source' => $revenue->source,
                'Description' => $revenue->description,
            ];
        });
    }

    public function headings(): array
    {
        return ['Date', 'Amount', 'Source', 'Description'];
    }
}
