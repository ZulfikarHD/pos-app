<?php

namespace App\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;

class OrderActions extends Component
{
    public $orderId;
    public $order;
    public $customers;
    public $products;
    public $orderItems = [];

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->order = Order::with('customer', 'orderItems.product')->findOrFail($orderId);
        $this->customers = Customer::all();
        $this->products = Product::all();
        $this->orderItems = $this->order->orderItems->map(function($item) {
            return [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'total' => $item->total,
            ];
        })->toArray();
    }

    public function updateOrder()
    {
        $this->validate([
            'order.customer_id' => 'required|exists:customers,id',
            'orderItems.*.product_id' => 'required|exists:products,id',
            'orderItems.*.quantity' => 'required|integer|min:1',
        ]);

        $this->order->update(['customer_id' => $this->order->customer_id]);

        $this->order->orderItems()->delete();
        foreach ($this->orderItems as $item) {
            $this->order->orderItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total' => $item['total'],
            ]);
        }

        session()->flash('message', 'Order updated successfully.');
        return redirect()->route('orders.view');
    }

    public function deleteOrder()
    {
        $this->order->delete();

        session()->flash('message', 'Order deleted successfully.');
        return redirect()->route('orders.view');
    }

    public function render()
    {
        return view('livewire.orders.order-actions');
    }
}
