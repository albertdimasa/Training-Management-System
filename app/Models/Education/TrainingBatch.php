<?php

namespace App\Models\Education;

use App\Enums\Education\BatchStatus;
use App\Enums\Education\ExecutionType;
use App\Models\Master\Venue;
use App\Models\Operation\OrderLine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_code',
        'course_id',
        'trainer_id',
        'venue_id',
        'execution_type',
        'start_date',
        'end_date',
        'quota',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'quota' => 'integer',
        'execution_type' => ExecutionType::class,
        'status' => BatchStatus::class,
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'trainer_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'batch_id');
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'batch_id');
    }
}
