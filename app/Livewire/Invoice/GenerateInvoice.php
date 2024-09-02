<?php
namespace App\Livewire\Invoice;

use Livewire\Component;
use App\Models\Order;
use App\Models\Invoice;

class GenerateInvoice extends Component
{
    public $orders;

    public function mount()
    {
        // Load orders that do not yet have an invoice
        $this->orders = Order::doesntHave('invoice')->with('orderItems')->get();
    }

    public function generateInvoice($orderId)
    {
        $order = Order::with('orderItems')->findOrFail($orderId);

        // Calculate the total amount
        $totalAmount = $order->orderItems->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        // Create the invoice
        Invoice::create([
            'order_id' => $order->id,
            'invoice_date' => now(),
            'total_amount' => $totalAmount,
            'status' => 'Pending', // or 'Unpaid'
        ]);

        session()->flash('message', 'Invoice generated successfully.');
        $this->orders = Order::doesntHave('invoice')->with('orderItems')->get(); // Refresh orders
    }

    public function render()
    {
        return view('livewire.invoice.generate-invoice');
    }
}
