<?php

namespace App\Models\Education;

use App\Enums\Education\EnrollStatus;
use App\Models\Operation\OrderLine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_line_id',
        'batch_id',
        'participant_id',
        'enroll_status',
        'score',
    ];

    protected $casts = [
        'enroll_status' => EnrollStatus::class,
        'score' => 'decimal:2',
    ];

    public function orderLine()
    {
        return $this->belongsTo(OrderLine::class);
    }

    public function batch()
    {
        return $this->belongsTo(TrainingBatch::class, 'batch_id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
}
