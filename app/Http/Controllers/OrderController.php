<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function edit()
    {
        return view('orders.edit', compact('order'));
    }
}
