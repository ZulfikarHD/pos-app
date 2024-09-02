<?php

namespace App\Livewire\Invoice;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Invoice;

class ViewInvoices extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $filterDateFrom = '';
    public $filterDateTo = '';
    public $perPage = 10;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
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
        $query = Invoice::with(['order.customer']);

        // Apply search filter
        if ($this->search) {
            $query->where('invoice_id', 'like', '%' . $this->search . '%')
                ->orWhereHas('order.customer', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
        }

        // Apply status filter
        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        // Apply date range filter
        if ($this->filterDateFrom) {
            $query->whereDate('invoice_date', '>=', $this->filterDateFrom);
        }
        if ($this->filterDateTo) {
            $query->whereDate('invoice_date', '<=', $this->filterDateTo);
        }

        $invoices = $query->orderBy('invoice_date', 'desc')->paginate($this->perPage);

        return view('livewire.invoice.view-invoices', [
            'invoices' => $invoices,
        ]);
    }
}
