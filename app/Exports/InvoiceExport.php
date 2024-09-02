<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection, WithHeadings
{
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function collection()
    {
        return collect([
            [
                'Invoice ID' => $this->invoice->invoice_id,
                'Order ID' => $this->invoice->order->order_id,
                'Customer' => $this->invoice->order->customer->name,
                'Total Amount' => number_format($this->invoice->total_amount, 2),
                'Status' => ucfirst($this->invoice->status),
                'Invoice Date' => $this->invoice->invoice_date->format('Y-m-d'),
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            'Invoice ID',
            'Order ID',
            'Customer',
            'Total Amount',
            'Status',
            'Invoice Date',
        ];
    }
}
