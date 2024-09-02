<?php

namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Payment;

class PaymentTracking extends Component
{
    public $invoice;
    public $paymentAmount;
    public $paymentDate;
    public $paymentMethod;
    public $paymentStatus;

    public function mount($id)
    {
        $this->invoice = Invoice::with('payments')->findOrFail($id);
        $this->paymentStatus = $this->invoice->status;
    }

    public function addPayment()
    {
        $this->validate([
            'paymentAmount' => 'required|numeric|min:1',
            'paymentDate' => 'required|date',
            'paymentMethod' => 'required|string',
        ]);

        // Add the payment to the invoice
        Payment::create([
            'invoice_id' => $this->invoice->id,
            'amount_paid' => $this->paymentAmount,
            'payment_date' => $this->paymentDate,
            'payment_method' => $this->paymentMethod,
        ]);

        // Update invoice total paid amount and status
        $totalPaid = $this->invoice->payments->sum('amount_paid') + $this->paymentAmount;

        if ($totalPaid >= $this->invoice->total_amount) {
            $this->invoice->status = 'Paid';
        } else {
            $this->invoice->status = 'Partially Paid';
        }

        $this->invoice->save();

        // Reset fields
        $this->paymentAmount = '';
        $this->paymentDate = '';
        $this->paymentMethod = '';
        $this->paymentStatus = $this->invoice->status;

        session()->flash('message', 'Payment added successfully.');
    }

    public function render()
    {
        return view('livewire.invoice.payment-tracking', [
            'payments' => $this->invoice->payments,
            'invoiceStatus' => $this->invoice->status,
        ]);
    }
}
