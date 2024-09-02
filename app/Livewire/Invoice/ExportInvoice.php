<?php

namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Invoice;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoiceExport;
use PDF;

class ExportInvoice extends Component
{
    public $invoice;

    public function mount($id)
    {
        $this->invoice = Invoice::with('order.customer', 'payments')->findOrFail($id);
    }

    public function exportPDF()
    {
        $pdf = PDF::loadView('invoices.pdf', ['invoice' => $this->invoice]);
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "invoice_{$this->invoice->invoice_id}.pdf"
        );
    }

    public function exportCSV()
    {
        return Excel::download(new InvoiceExport($this->invoice), "invoice_{$this->invoice->invoice_id}.csv");
    }

    public function render()
    {
        return view('livewire.invoice.export-invoice');
    }
}
