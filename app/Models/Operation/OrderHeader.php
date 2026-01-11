<?php

namespace App\Models\Operation;

use App\Enums\Operation\OrderStatus;
use App\Enums\Operation\ResourceType;
use App\Models\Master\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    use HasFactory;

    protected $table = 'order_headers';

    protected $fillable = [
        'order_no',
        'order_date',
        'client_id',
        'resource_type',
        'status',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'date',
        'resource_type' => ResourceType::class,
        'status' => OrderStatus::class,
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lines()
    {
        return $this->hasMany(OrderLine::class, 'order_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'order_id');
    }
}
