<?php

namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Invoice;

class EditInvoice extends Component
{
    public $invoice;
    public $invoiceId;
    public $totalAmount;
    public $status;

    public function mount($id)
    {
        $this->invoice = Invoice::findOrFail($id);
        $this->invoiceId = $this->invoice->invoice_id;
        $this->totalAmount = $this->invoice->total_amount;
        $this->status = $this->invoice->status;
    }

    public function updateInvoice()
    {
        $this->validate([
            'totalAmount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        $this->invoice->update([
            'total_amount' => $this->totalAmount,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Invoice updated successfully.');
        return redirect()->route('invoices.index');
    }

    public function render()
    {
        return view('livewire.invoice.edit-invoice');
    }
}
