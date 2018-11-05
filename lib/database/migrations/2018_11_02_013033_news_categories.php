<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('news_categories_title')->nullable();
            $table->string('news_categories_description')->nullable();
            $table->string('news_categories_keyword')->nullable();
            $table->string('news_categories_avatar')->nullable();
            $table->string('news_categories_tags')->nullable();
            $table->string('news_categories_lang_code')->default('en');
            $table->tinyInteger('IsDelete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_categories');
    }
}
