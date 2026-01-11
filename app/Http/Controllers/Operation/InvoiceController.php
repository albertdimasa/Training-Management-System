<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\Operation\Invoice;
use App\Models\Operation\OrderHeader;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['order.client', 'payments'])->latest()->paginate(20);
        return view('operation.invoice.index', compact('invoices'));
    }
}
