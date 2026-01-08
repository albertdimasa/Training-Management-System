<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\TrainingSchedule;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
    ];

    public function trainingSchedules()
    {
        return $this->hasMany(TrainingSchedule::class);
    }
}
