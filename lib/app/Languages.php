<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $fillable = [
        'lang_code',
        'lang_description',
        'IsDelete',
    ];
}
