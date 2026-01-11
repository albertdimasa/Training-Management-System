<?php

namespace App\Models\Operation;

use App\Models\Education\Course;
use App\Models\Education\TrainingBatch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'batch_id',
        'course_id',
        'qty_participant',
        'unit_price',
        'discount_amt',
        'tax_rate',
        'line_total',
    ];

    protected $casts = [
        'qty_participant' => 'integer',
        'unit_price' => 'decimal:2',
        'discount_amt' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'line_total' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(OrderHeader::class, 'order_id');
    }

    public function batch()
    {
        return $this->belongsTo(TrainingBatch::class, 'batch_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
