<?php

namespace App\Livewire\PackingList;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PackingList;
use App\Models\Order;

class PackingListView extends Component
{
    use WithPagination;

    public $search = '';
    public $filterOrderId = '';
    public $filterCustomer = '';
    public $filterDateFrom = '';
    public $filterDateTo = '';
    public $perPage = 10;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterOrderId()
    {
        $this->resetPage();
    }

    public function updatingFilterCustomer()
    {
        $this->resetPage();
    }

    public function updatingFilterDateFrom()
    {
        $this->resetPage();
    }

    public function updatingFilterDateTo()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = PackingList::with(['order.customer']);

        // Apply search filter
        if ($this->search) {
            $query->whereHas('order', function ($q) {
                $q->where('order_id', 'like', '%' . $this->search . '%')
                  ->orWhereHas('customer', function ($q2) {
                      $q2->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Apply Order ID filter
        if ($this->filterOrderId) {
            $query->where('order_id', $this->filterOrderId);
        }

        // Apply Customer filter
        if ($this->filterCustomer) {
            $query->whereHas('order.customer', function ($q) {
                $q->where('name', 'like', '%' . $this->filterCustomer . '%');
            });
        }

        // Apply Date Range filter
        if ($this->filterDateFrom) {
            $query->whereDate('packing_date', '>=', $this->filterDateFrom);
        }
        if ($this->filterDateTo) {
            $query->whereDate('packing_date', '<=', $this->filterDateTo);
        }

        $packingLists = $query->orderBy('packing_date', 'desc')->paginate($this->perPage);

        return view('livewire.packing-list.packing-list-view', [
            'packingLists' => $packingLists,
        ]);
    }
}
