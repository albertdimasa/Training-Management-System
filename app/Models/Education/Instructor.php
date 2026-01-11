<?php

namespace App\Models\Education;

use App\Enums\Education\TrainerLevel;
use App\Enums\Education\TrainerStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_code',
        'trainer_name',
        'specialization',
        'level',
        'daily_rate',
        'status',
        'user_id',
    ];

    protected $casts = [
        'level' => TrainerLevel::class,
        'daily_rate' => 'decimal:2',
        'status' => TrainerStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingBatches()
    {
        return $this->hasMany(TrainingBatch::class, 'trainer_id');
    }

    // Alias for trainingBatches relationship
    public function batches()
    {
        return $this->trainingBatches();
    }
}
