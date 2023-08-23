<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;

class TrainingNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'message' => CleanHtml::class,
    ];

    public function student()
    {
        return $this->belongsTo(ATC::class, 'atc_id');
    }
}
