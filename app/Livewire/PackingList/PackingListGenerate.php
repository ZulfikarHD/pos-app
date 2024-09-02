<?php

namespace App\Livewire\PackingList;

use Livewire\Component;
use App\Models\Order;
use App\Models\PackingList;

class PackingListGenerate extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::whereDoesntHave('packingList')->with('orderItems')->get();
    }

    public function generatePackingList($orderId)
    {
        $order = Order::with('orderItems')->findOrFail($orderId);

        // Create a new packing list for the order
        $packingList = PackingList::create([
            'order_id' => $order->id,
            'packing_date' => now(),
            // Add more fields as necessary
        ]);

        // Optionally, add order items to the packing list if you track them separately
        foreach ($order->orderItems as $item) {
            // Assuming you have a packing_items table (adjust as needed)
            $packingList->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                // Add more fields if needed
            ]);
        }

        session()->flash('message', 'Packing list generated successfully.');
        $this->orders = Order::whereDoesntHave('packingList')->with('orderItems')->get(); // Refresh orders
    }

    public function render()
    {
        return view('livewire.packing-list.packing-list-generate');
    }
}
