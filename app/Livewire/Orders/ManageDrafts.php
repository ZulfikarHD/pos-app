<?php
namespace App\Livewire\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\Customer;

class ManageDrafts extends Component
{
    use WithPagination;

    public $search = '';
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

    public function resumeDraft($orderId)
    {
        // Logic to resume editing the draft order
        return redirect()->route('orders.edit', $orderId);
    }

    public function submitDraft($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => 'Submitted']);

        session()->flash('message', 'Draft order submitted successfully.');
        $this->resetPage();
    }

    public function deleteDraft($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();

        session()->flash('message', 'Draft order deleted successfully.');
        $this->resetPage();
    }

    public function render()
    {
        $drafts = Order::query()
            ->with('customer')
            ->where('status', 'Draft')
            ->when($this->search, function($query) {
                $query->where('order_id', 'like', '%' . $this->search . '%')
                      ->orWhereHas('customer', function($query) {
                          $query->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->when($this->filterCustomer, function($query) {
                $query->where('customer_id', $this->filterCustomer);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $customers = Customer::all();

        return view('livewire.orders.manage-drafts', [
            'drafts' => $drafts,
            'customers' => $customers,
        ]);
    }
}
