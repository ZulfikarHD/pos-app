<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $subject;
    public $messageBody;

    public function __construct(Invoice $invoice, $subject, $messageBody)
    {
        $this->invoice = $invoice;
        $this->subject = $subject;
        $this->messageBody = $messageBody;
    }

    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.invoice')
            ->with([
                'invoice' => $this->invoice,
                'messageBody' => $this->messageBody,
            ])
            ->attachData($this->generatePDF(), 'invoice.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    protected function generatePDF()
    {
        $pdf = \PDF::loadView('invoices.pdf', ['invoice' => $this->invoice]);
        return $pdf->output();
    }
}
