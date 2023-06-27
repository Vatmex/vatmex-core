<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATC extends Model
{
    use HasFactory;

    protected $table = 'atcs';

    protected $casts = [
        'delivery' => 'boolean',
        'ground' => 'boolean',
        'tower' => 'boolean',
        'approach' => 'boolean',
        'center' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'atc_id');
    }
}
