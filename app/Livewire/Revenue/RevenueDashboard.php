<?php

namespace App\Livewire\Revenue;

use Livewire\Component;
use App\Models\Revenue;
use Carbon\Carbon;

class RevenueDashboard extends Component
{
    public $dailyTotal;
    public $weeklyTotal;
    public $monthlyTotal;

    public function mount()
    {
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->dailyTotal = Revenue::whereDate('revenue_date', Carbon::today())->sum('amount');
        $this->weeklyTotal = Revenue::whereBetween('revenue_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $this->monthlyTotal = Revenue::whereMonth('revenue_date', Carbon::now()->month)->sum('amount');
    }

    public function render()
    {
        return view('livewire.revenue.revenue-dashboard');
    }
}
