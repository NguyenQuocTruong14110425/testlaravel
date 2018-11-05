<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = [
        'tags_title',
        'tags_description',
        'tags_lang_code',
        'IsDelete',
    ];
}
