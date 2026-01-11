<?php

namespace App\Models\Financial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalHeader extends Model
{
    use HasFactory;

    protected $table = 'journal_headers';

    protected $fillable = [
        'journal_no',
        'journal_date',
        'source_table',
        'source_id',
        'memo',
    ];

    protected $casts = [
        'journal_date' => 'date',
    ];

    public function lines()
    {
        return $this->hasMany(JournalLine::class, 'journal_id');
    }
}
