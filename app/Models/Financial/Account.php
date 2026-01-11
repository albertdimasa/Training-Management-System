<?php

namespace App\Models\Financial;

use App\Enums\Financial\AccountType;
use App\Enums\Financial\NormalSide;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_code',
        'account_name',
        'account_type',
        'is_header',
        'parent_id',
        'normal_side',
    ];

    protected $casts = [
        'account_type' => AccountType::class,
        'is_header' => 'boolean',
        'normal_side' => NormalSide::class,
    ];

    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    public function journalLines()
    {
        return $this->hasMany(JournalLine::class);
    }
}
