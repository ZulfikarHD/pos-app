<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Payment;
use DB;

class Dashboard extends Component
{
    public $totalSales;
    public $activeOrders;
    public $customerSatisfaction;
    public $lowStockProducts;
    public $recentActivities = [];
    public $salesSummary = [];

    public function mount()
    {
        $this->totalSales = $this->calculateTotalSales();
        $this->activeOrders = $this->calculateActiveOrders();
        $this->customerSatisfaction = $this->calculateCustomerSatisfaction();
        $this->lowStockProducts = Product::where('stock_quantity', '<=', 10)->get();
        $this->recentActivities = $this->getRecentActivities();
        $this->salesSummary = $this->getSalesSummary();
    }

    private function calculateTotalSales()
    {
        // Calculate total sales by summing the products of quantity and unit_price
        return OrderItem::whereHas('order', function($query) {
                $query->where('status', 'Completed');
            })
            ->selectRaw('SUM(quantity * unit_price) as total_sales')
            ->pluck('total_sales')
            ->first();
    }

    private function calculateActiveOrders()
    {
        return Order::where('status', '!=', 'Completed')->count();
    }

    private function calculateCustomerSatisfaction()
    {
        // Check if `satisfaction_score` exists in Customer table
        if (!\Schema::hasColumn('customers', 'satisfaction_score')) {
            return null; // Or handle differently if this field is missing
        }

        $totalCustomers = Customer::count();
        $happyCustomers = Customer::where('satisfaction_score', '>=', 8)->count();

        return ($totalCustomers > 0) ? ($happyCustomers / $totalCustomers) * 100 : 0;
    }

    private function getRecentActivities()
    {
        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();
        $recentPayments = Payment::orderBy('payment_date', 'desc')->take(5)->get();

        return $recentOrders->merge($recentPayments)->sortByDesc('created_at');
    }

    private function getSalesSummary()
    {
        return [
            'daily' => OrderItem::whereDate('created_at', today())->selectRaw('SUM(quantity * unit_price) as total')->pluck('total')->first(),
            'weekly' => OrderItem::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->selectRaw('SUM(quantity * unit_price) as total')->pluck('total')->first(),
            'monthly' => OrderItem::whereMonth('created_at', now()->month)->selectRaw('SUM(quantity * unit_price) as total')->pluck('total')->first(),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
