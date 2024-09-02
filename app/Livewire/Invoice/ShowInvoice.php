<?php

namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Invoice;

class ShowInvoice extends Component
{
    public $invoice;

    public function mount($id)
    {
        $this->invoice = Invoice::with('order.customer', 'payments')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.invoice.show-invoice');
    }
}
