<?php

namespace App\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderLog;

class ProcessOrder extends Component
{
    public $orders;
    public $selectedStatus = '';
    public $selectedOrders = [];
    public $selectAll = false;

    public function mount()
    {
        $this->orders = Order::with('customer')->get(); // Adjust to paginate if necessary
    }

    public function updateStatus($orderId, $newStatus)
    {
        $order = Order::findOrFail($orderId);
        $previousStatus = $order->status;
        $order->status = $newStatus;
        $order->save();

        // Log the status change
        OrderLog::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'action' => 'Status Updated',
            'description' => "Order status changed from $previousStatus to $newStatus",
        ]);

        $this->orders = Order::with('customer')->get(); // Refresh orders list
        session()->flash('message', 'Order status updated successfully.');
    }

    public function batchUpdateStatus()
    {
        if ($this->selectedStatus && !empty($this->selectedOrders)) {
            $orders = Order::whereIn('id', $this->selectedOrders)->get();

            foreach ($orders as $order) {
                $previousStatus = $order->status;
                $order->status = $this->selectedStatus;
                $order->save();

                // Log the batch status change
                OrderLog::create([
                    'order_id' => $order->id,
                    'user_id' => auth()->id(),
                    'action' => 'Batch Status Update',
                    'description' => "Order status changed from $previousStatus to $this->selectedStatus",
                ]);
            }

            $this->selectedOrders = [];
            $this->selectedStatus = '';
            $this->orders = Order::with('customer')->get(); // Refresh orders list

            session()->flash('message', 'Order statuses updated successfully.');
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedOrders = $this->orders->pluck('id')->toArray();
        } else {
            $this->selectedOrders = [];
        }
    }

    public function render()
    {
        return view('livewire.orders.process-order');
    }
}
