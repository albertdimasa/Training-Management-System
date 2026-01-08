<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Course;
use App\Models\Master\Instructor;

class TrainingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'instructor_id',
        'date',
        'capacity',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'schedule_id');
    }
}
