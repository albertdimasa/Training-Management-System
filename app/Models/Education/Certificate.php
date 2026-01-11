<?php

namespace App\Models\Education;

use App\Enums\Education\CertificateStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'certificate_no',
        'issued_date',
        'expiry_date',
        'status',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
        'status' => CertificateStatus::class,
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
