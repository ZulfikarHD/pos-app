<?php

namespace App\Exports;

use App\Models\PackingList;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PackingListExport implements FromCollection, WithMapping, WithHeadings
{
    protected $packingList;

    public function __construct(PackingList $packingList)
    {
        $this->packingList = $packingList;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->packingList->items;
    }

    /**
     * Map data for each row
     */
    public function map($item): array
    {
        return [
            $item->product->name,
            $item->quantity,
            // Add more fields as necessary
        ];
    }

    /**
     * Define headings
     */
    public function headings(): array
    {
        return [
            'Product Name',
            'Quantity',
            // Add more headings as necessary
        ];
    }
}
