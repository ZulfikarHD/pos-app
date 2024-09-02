<?php

namespace App\Livewire\Revenue;

use Livewire\Component;
use App\Models\Revenue;

class AddRevenue extends Component
{
    public $revenueDate;
    public $amount;
    public $source;
    public $description;

    public function mount()
    {
        $this->revenueDate = now()->format('Y-m-d');
    }

    public function addRevenue()
    {
        $this->validate([
            'revenueDate' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Revenue::create([
            'revenue_date' => $this->revenueDate,
            'amount' => $this->amount,
            'source' => $this->source,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Revenue added successfully.');
        $this->reset(['amount', 'source', 'description']);
    }

    public function render()
    {
        return view('livewire.revenue.add-revenue');
    }
}
