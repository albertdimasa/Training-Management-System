<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\Operation\OrderHeader;
use App\Models\Master\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = OrderHeader::with(['client', 'lines'])->latest()->paginate(20);
        return view('operation.order.index', compact('orders'));
    }
}
