<?php

namespace App\Livewire\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\Customer;

class ViewOrders extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $filterCustomer = '';
    public $sortField = 'order_date';
    public $sortDirection = 'desc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $orders = Order::query()
            ->with('customer')
            ->when($this->search, function ($query) {
                $query->where('order_id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('customer', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterCustomer, function ($query) {
                $query->where('customer_id', $this->filterCustomer);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $customers = Customer::all();

        return view('livewire.orders.view-orders', [
            'orders' => $orders,
            'customers' => $customers,
        ]);
    }

    public function deleteOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();

        session()->flash('message', 'Order deleted successfully.');
        $this->resetPage(); // Refresh the pagination to reflect the deletion
    }

    public function confirmDelete($orderId)
    {
        $this->dispatchBrowserEvent('show-delete-confirmation', ['orderId' => $orderId]);
    }
}
