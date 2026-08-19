<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeepTranslation extends Model
{
    protected $fillable = [
        'original_hash',
        'lang_code',
        'translated_text'
    ];
}
