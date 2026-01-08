<?php

namespace App\Models\Transaction;

use App\Models\Transaction\TrainingSchedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RegistrationStatus;
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
