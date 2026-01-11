<?php

namespace Database\Seeders;

use App\Models\Operation\Invoice;
use App\Models\Operation\OrderHeader;
use App\Models\Operation\OrderLine;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['UNPAID', 'PARTIAL', 'PAID'];

        // Only create invoices for CONFIRMED/COMPLETED orders
        $orders = OrderHeader::whereIn('status', ['CONFIRMED', 'COMPLETED'])->get();

        foreach ($orders as $order) {
            // Calculate totals from order lines
            $lines = OrderLine::where('order_id', $order->id)->get();

            $subtotal = $lines->sum(function ($line) {
                return $line->qty_participant * $line->unit_price;
            });

            $discountTotal = $lines->sum('discount_amt');

            $taxTotal = $lines->sum(function ($line) {
                $base = max(($line->qty_participant * $line->unit_price) - $line->discount_amt, 0);
                return $base * ($line->tax_rate / 100);
            });

            $grandTotal = ($subtotal - $discountTotal) + $taxTotal;

            Invoice::create([
                'invoice_no' => 'INV-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
                'order_id' => $order->id,
                'invoice_date' => $order->order_date->addDays(rand(1, 10)),
                'due_date' => $order->order_date->addDays(rand(15, 45)),
                'status' => $statuses[array_rand($statuses)],
                'subtotal' => round($subtotal, 2),
                'discount_total' => round($discountTotal, 2),
                'tax_total' => round($taxTotal, 2),
                'grand_total' => round($grandTotal, 2),
                'created_at' => now()->subDays(rand(0, 650)),
            ]);
        }
    }
}
