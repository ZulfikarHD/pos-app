<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Orders\CreateOrder;
use App\Livewire\Orders\ViewOrders;
use App\Livewire\Orders\ManageDrafts;
use App\Livewire\Orders\OrderDetails;
use App\Livewire\Dashboard;

// Dashboard Route
Route::get('/dashboard', Dashboard::class)->name('dashboard');

// Order Management Routes
Route::get('/orders/create', CreateOrder::class)->name('orders.create');
Route::get('/orders', ViewOrders::class)->name('orders.view');
Route::get('/orders/drafts', ManageDrafts::class)->name('orders.drafts');
Route::get('/orders/{order}', OrderDetails::class)->name('orders.show');

// Edit Order Route
Route::get('/orders/{order}/edit', CreateOrder::class)->name('orders.edit');



Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');



require __DIR__.'/auth.php';
