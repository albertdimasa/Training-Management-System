<?php

namespace App\Models\Education;

use App\Enums\Education\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_code',
        'full_name',
        'gender',
        'dob',
        'city',
        'phone',
        'email',
    ];

    protected $casts = [
        'gender' => Gender::class,
        'dob' => 'date',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
