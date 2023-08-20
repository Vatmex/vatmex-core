<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class TrainingNote extends Model
{
    use HasFactory;

    protected $casts = [
        'message' => CleanHtml::class,
    ];

    public function student()
    {
        return $this->belongsTo(ATC::class, 'atc_id');
    }
}
