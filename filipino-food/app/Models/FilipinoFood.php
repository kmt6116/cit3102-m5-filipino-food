<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilipinoFood extends Model
{
    protected $table = 'filipino_food';

    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'availability',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'availability' => 'boolean',
    ];
}
