<?php

namespace App\Models\Master;

use App\Enums\Master\ClientStatus;
use App\Enums\Master\ClientType;
use App\Models\Operation\OrderHeader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_code',
        'client_name',
        'client_type',
        'industry',
        'city',
        'status',
    ];

    protected $casts = [
        'client_type' => ClientType::class,
        'status' => ClientStatus::class,
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function primaryContact()
    {
        return $this->hasOne(Contact::class)->where('is_primary', true);
    }

    public function orders()
    {
        return $this->hasMany(OrderHeader::class);
    }
}
