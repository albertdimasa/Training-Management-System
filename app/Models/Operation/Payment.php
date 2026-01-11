<?php

namespace App\Models\Operation;

use App\Enums\Operation\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_no',
        'invoice_id',
        'payment_date',
        'method',
        'amount',
        'reference_no',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'method' => PaymentMethod::class,
        'amount' => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
