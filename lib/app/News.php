<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'news_detail_title',
        'news_detail_desciption',
        'news_detail_content',
        'news_keyword',
        'news_tag',
        'news_slug',
        'news_avatar',
        'news_categories',
        'news_publish',
        'news_status',
        'news_views',
        'news_link1',
        'news_link2',
        'news_link3',
        'news_sort',
        'news_lang_code',
        'IsDelete',
        'news_categories_id'
    ];
}
