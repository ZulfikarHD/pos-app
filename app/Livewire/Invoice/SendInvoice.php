<?php

namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class SendInvoice extends Component
{
    public $invoice;
    public $recipientEmail;
    public $subject = 'Your Invoice from Our Company';
    public $messageBody = 'Please find your invoice attached.';

    public function mount($id)
    {
        $this->invoice = Invoice::with('order.customer')->findOrFail($id);
        $this->recipientEmail = $this->invoice->order->customer->email;
    }

    public function sendInvoice()
    {
        $this->validate([
            'recipientEmail' => 'required|email',
            'subject' => 'required|string|max:255',
            'messageBody' => 'required|string',
        ]);

        // Send the email
        Mail::to($this->recipientEmail)->send(new InvoiceMail($this->invoice, $this->subject, $this->messageBody));

        session()->flash('message', 'Invoice sent successfully to ' . $this->recipientEmail);
        return redirect()->route('invoices.show', $this->invoice->id);
    }

    public function render()
    {
        return view('livewire.invoice.send-invoice');
    }
}
