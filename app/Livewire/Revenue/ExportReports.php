<?php

namespace App\Livewire\Revenue;

use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RevenueExport;
use PDF;
use App\Models\Revenue;
use Carbon\Carbon;

class ExportReports extends Component
{
    public $dateFrom;
    public $dateTo;
    public $source;

    public function exportPDF()
    {
        $revenues = $this->queryRevenue()->get();
        $pdf = PDF::loadView('exports.revenue-pdf', compact('revenues'));

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'revenue_report_' . Carbon::now()->format('Y-m-d') . '.pdf'
        );
    }

    public function exportCSV()
    {
        return Excel::download(new RevenueExport($this->queryRevenue()->get()), 'revenue_report_' . Carbon::now()->format('Y-m-d') . '.csv');
    }

    protected function queryRevenue()
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

        return $query;
    }

    public function render()
    {
        return view('livewire.revenue.export-reports');
    }
}
