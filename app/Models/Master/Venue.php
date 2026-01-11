<?php

namespace App\Models\Master;

use App\Enums\Master\VenueType;
use App\Models\Education\TrainingBatch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_name',
        'city',
        'capacity',
        'venue_type',
    ];

    protected $casts = [
        'venue_type' => VenueType::class,
        'capacity' => 'integer',
    ];

    public function trainingBatches()
    {
        return $this->hasMany(TrainingBatch::class);
    }
}
