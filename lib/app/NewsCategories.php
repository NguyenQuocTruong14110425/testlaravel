<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategories extends Model
{
    protected $fillable = [
        'news_categories_title',
        'news_categories_description',
        'news_categories_keyword',
        'news_categories_avatar',
        'news_categories_tags',
        'news_categories_lang_code',
        'IsDelete',
    ];
}
