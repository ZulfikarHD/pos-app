<?php

namespace App\Livewire\Orders;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CreateOrder extends Component
{
    public $customers;
    public $products;
    public $selectedCustomer = '';
    public $orderItems = [];
    public $subtotal = 0;
    public $taxRate = 11;
    public $taxAmount = 0;
    public $total = 0;
    public $showCustomerForm = false;
    public $newCustomer = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
    ];
    public $orderId = null;  // New property to track if we're editing an order

    public function mount($orderId = null)
    {
        $this->customers = Customer::all();
        $this->products = Product::all();

        if ($orderId) {
            // We're in edit mode, so load the existing order
            $this->orderId = $orderId;
            $order = Order::with('orderItems')->findOrFail($orderId);
            $this->selectedCustomer = $order->customer_id;

            foreach ($order->orderItems as $item) {
                $this->orderItems[] = [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total' => $item->total,
                ];
            }

            $this->calculateTotals();
        } else {
            $this->orderItems[] = ['product_id' => '', 'quantity' => 1, 'unit_price' => 0, 'total' => 0];
        }
    }

    public function updatedOrderItems()
    {
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = 0;
        foreach ($this->orderItems as &$item) {
            if ($item['product_id']) {
                $product = Product::find($item['product_id']);
                $item['unit_price'] = $product->price;
                $item['total'] = $item['unit_price'] * $item['quantity'];
                $this->subtotal += $item['total'];
            }
        }
        $this->taxAmount = ($this->subtotal * $this->taxRate) / 100;
        $this->total = $this->subtotal + $this->taxAmount;
    }

    public function addItem()
    {
        $this->orderItems[] = ['product_id' => '', 'quantity' => 1, 'unit_price' => 0, 'total' => 0];
    }

    public function removeItem($index)
    {
        unset($this->orderItems[$index]);
        $this->orderItems = array_values($this->orderItems);
        $this->calculateTotals();
    }

    public function showCustomerForm()
    {
        $this->showCustomerForm = true;
    }

    public function addCustomer()
    {
        $this->validate([
            'newCustomer.name' => 'required|string|max:255',
            'newCustomer.email' => 'required|email|max:255|unique:customers,email',
            'newCustomer.phone' => 'required|string|max:15',
            'newCustomer.address' => 'required|string|max:255',
        ]);

        $customer = Customer::create($this->newCustomer);
        $this->selectedCustomer = $customer->id;
        $this->customers = Customer::all();
        $this->showCustomerForm = false;
    }

    public function saveDraft()
    {
        $order = $this->orderId ? Order::findOrFail($this->orderId) : new Order();

        $order->customer_id = $this->selectedCustomer;
        $order->user_id = auth()->id();
        $order->order_date = now();
        $order->status = 'Draft';
        $order->save();

        // Clear old order items if editing
        if ($this->orderId) {
            OrderItem::where('order_id', $this->orderId)->delete();
        }

        foreach ($this->orderItems as $item) {
            if ($item['product_id']) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['total'],
                ]);
            }
        }

        session()->flash('message', 'Order saved as draft.');
        return redirect()->route('orders.view');
    }

    public function submitOrder()
    {
        $order = $this->orderId ? Order::findOrFail($this->orderId) : new Order();

        $order->customer_id = $this->selectedCustomer;
        $order->user_id = auth()->id();
        $order->order_date = now();
        $order->status = 'Submitted';
        $order->save();

        // Clear old order items if editing
        if ($this->orderId) {
            OrderItem::where('order_id', $this->orderId)->delete();
        }

        foreach ($this->orderItems as $item) {
            if ($item['product_id']) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['total'],
                ]);
            }
        }

        session()->flash('message', 'Order submitted successfully.');
        return redirect()->route('orders.view');
    }

    public function render()
    {
        return view('livewire.orders.create-order');
    }
}
