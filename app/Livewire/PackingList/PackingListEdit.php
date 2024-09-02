<?php

namespace App\Livewire\PackingList;

use Livewire\Component;
use App\Models\PackingList;
use App\Models\OrderItem;
use App\Models\Product;

class PackingListEdit extends Component
{
    public $packingList;
    public $orderItems = [];
    public $products;
    public $shippingStatus;
    public $trackingDetails;

    public function mount($packingListId)
    {
        $this->packingList = PackingList::with('order.orderItems.product')->findOrFail($packingListId);
        $this->orderItems = $this->packingList->order->orderItems->toArray();
        $this->products = Product::all();
        $this->shippingStatus = $this->packingList->shipping_status;
        $this->trackingDetails = $this->packingList->tracking_details;
    }

    public function updateItemQuantity($index, $quantity)
    {
        $this->orderItems[$index]['quantity'] = $quantity;
    }

    public function addItem()
    {
        $this->orderItems[] = ['product_id' => '', 'quantity' => 1];
    }

    public function removeItem($index)
    {
        unset($this->orderItems[$index]);
        $this->orderItems = array_values($this->orderItems);
    }

    public function savePackingList()
    {
        // Update existing items in the order
        foreach ($this->orderItems as $item) {
            if (isset($item['id'])) {
                $orderItem = OrderItem::find($item['id']);
                $orderItem->update(['quantity' => $item['quantity']]);
            } else {
                // Add new items to the order
                $this->packingList->order->orderItems()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => Product::find($item['product_id'])->price,
                ]);
            }
        }

        // Optionally, delete removed items from the database
        $currentItemIds = collect($this->orderItems)->pluck('id')->filter()->toArray();
        $this->packingList->order->orderItems()->whereNotIn('id', $currentItemIds)->delete();

        // Update shipping status and tracking details
        $this->packingList->update([
            'shipping_status' => $this->shippingStatus,
            'tracking_details' => $this->trackingDetails,
        ]);

        session()->flash('message', 'Packing list updated successfully.');
        return redirect()->route('packing-lists.index');
    }

    public function render()
    {
        return view('livewire.packing-list.packing-list-edit');
    }
}
