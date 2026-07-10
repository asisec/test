<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'url',
        'is_active',
        'position',
        'click_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
