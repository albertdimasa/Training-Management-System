<?php

namespace App\Models\Education;

use App\Enums\Education\CourseStatus;
use App\Models\Operation\OrderLine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_title',
        'category',
        'certificator',
        'duration_days',
        'base_price',
        'status',
    ];

    protected $casts = [
        'duration_days' => 'integer',
        'base_price' => 'decimal:2',
        'status' => CourseStatus::class,
    ];

    public function trainingBatches()
    {
        return $this->hasMany(TrainingBatch::class);
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
