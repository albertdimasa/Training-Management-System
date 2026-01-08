<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'user_name',
        'user_phone',
        'status',
    ];

    public function schedule()
    {
        return $this->belongsTo(TrainingSchedule::class, 'schedule_id');
    }
}
