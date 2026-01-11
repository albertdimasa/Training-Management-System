<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\Operation\Payment;
use App\Models\Operation\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['invoice.order.client'])->latest()->paginate(20);
        return view('operation.payment.index', compact('payments'));
    }
}
