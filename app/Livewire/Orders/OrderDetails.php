<?php

namespace App\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;

class OrderDetails extends Component
{
    public $orderId;
    public $order;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->order = Order::with('customer', 'orderItems.product')->findOrFail($orderId);
    }

    public function render()
    {
        return view('livewire.orders.order-details');
    }
}
