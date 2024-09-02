<?php

namespace App\Livewire\Revenue;

use Livewire\Component;
use App\Models\Revenue;
use Carbon\Carbon;

class RevenueReports extends Component
{
    public $dateFrom;
    public $dateTo;
    public $source;
    public $reports = [];

    public function generateReport()
    {
        $query = Revenue::query();

        if ($this->dateFrom) {
            $query->whereDate('revenue_date', '>=', Carbon::parse($this->dateFrom));
        }

        if ($this->dateTo) {
            $query->whereDate('revenue_date', '<=', Carbon::parse($this->dateTo));
        }

        if ($this->source) {
            $query->where('source', 'like', '%' . $this->source . '%');
        }

        $this->reports = $query->get();
    }

    public function render()
    {
        return view('livewire.revenue.revenue-reports', [
            'reports' => $this->reports,
        ]);
    }
}
