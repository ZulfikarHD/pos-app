<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackingList;
use PDF; // Assuming you're using a PDF package like barryvdh/laravel-dompdf
use Maatwebsite\Excel\Facades\Excel; // Assuming you're using Laravel Excel for CSV
use App\Exports\PackingListExport;

class PackingListController extends Controller
{
    /**
     * Export the specified packing list.
     */
    public function export($id, Request $request)
    {
        $packingList = PackingList::with(['order.customer', 'items.product'])->findOrFail($id);

        $format = $request->query('format', 'pdf'); // default to PDF

        if ($format === 'csv') {
            return Excel::download(new PackingListExport($packingList), 'packing_list_' . $packingList->id . '.csv');
        } elseif ($format === 'print') {
            return view('packing-lists.print', compact('packingList'));
        } else {
            $pdf = PDF::loadView('packing-lists.pdf', compact('packingList'));
            return $pdf->download('packing_list_' . $packingList->id . '.pdf');
        }
    }
}
