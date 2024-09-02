<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Orders\CreateOrder;
use App\Livewire\Orders\ViewOrders;
use App\Livewire\Orders\ManageDrafts;
use App\Livewire\Orders\OrderDetails;
use App\Livewire\Orders\ProcessOrder;
use App\Livewire\Dashboard;
use App\Http\Controllers\PackingListController;
use App\Livewire\Invoice\GenerateInvoice;
use App\Livewire\PackingList\PackingListGenerate;
use App\Livewire\PackingList\PackingListEdit;
use App\Livewire\Invoice\ViewInvoices;
use App\Livewire\Invoice\EditInvoice;
use App\Livewire\Invoice\ShowInvoice;
use App\Livewire\Invoice\ExportInvoice;

// Dashboard Route
Route::get('/dashboard', Dashboard::class)->name('dashboard');

// Order Management Routes
Route::get('/orders/create', CreateOrder::class)->name('orders.create');
Route::get('/orders', ViewOrders::class)->name('orders.view');
Route::get('/orders/process-orders', ProcessOrder::class)->name('orders.process-order');
Route::get('/orders/drafts', ManageDrafts::class)->name('orders.drafts');
Route::get('/orders/{order}', OrderDetails::class)->name('orders.show');

// Edit Order Route
Route::get('/orders/{order}/edit', CreateOrder::class)->name('orders.edit');


Route::prefix('packing-lists')->group(function () {
    Route::get('/', \App\Livewire\PackingList\PackingListView::class)->name('packing-lists.index');
    Route::get('/generate', PackingListGenerate::class)->name('packing-lists.generate');
    // Route::get('/create', [PackingListController::class, 'create'])->name('packing-lists.create');
    // Route::post('/store', [PackingListController::class, 'store'])->name('packing-lists.store');
    Route::get('/{id}/edit', PackingListEdit::class)->name('packing-lists.edit');
    Route::put('/{id}', [PackingListController::class, 'update'])->name('packing-lists.update');
    Route::get('/{id}', [PackingListController::class, 'show'])->name('packing-lists.show');
    Route::get('/{id}/export', [PackingListController::class, 'export'])->name('packing-lists.export');
});


Route::prefix('invoices')->group(function () {
    Route::get('/', ViewInvoices::class)->name('invoices.index');
    Route::get('/{id}/edit', EditInvoice::class)->name('invoices.edit');
    // Route::get('/{id}', ShowInvoice::class)->name('invoices.show');
    // Route::get('/{id}/export', ExportInvoice::class)->name('invoices.export');
});
Route::get('/invoice/generate',GenerateInvoice::class)->name('invoice.generate');

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');



require __DIR__ . '/auth.php';
