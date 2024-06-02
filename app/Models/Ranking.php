<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'user_id',
        'result_cal',
        'result_rank',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternative::class, 'alternative_id');
    }
}
