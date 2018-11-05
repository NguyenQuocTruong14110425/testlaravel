<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('news_detail_title')->nullable();
            $table->string('news_detail_desciption')->nullable();
            $table->longText('news_detail_content')->nullable();
            $table->string('news_keyword')->nullable();
            $table->string('news_tag')->nullable();
            $table->string('news_slug')->nullable();
            $table->string('news_avatar')->nullable();
            $table->string('news_categories')->nullable();
            $table->string('news_publish')->default('publish');
            $table->string('news_status')->default('news');
            $table->integer('news_views')->default(1);
            $table->string('news_link1')->nullable();
            $table->string('news_link2')->nullable();
            $table->string('news_link3')->nullable();
            $table->string('news_sort')->nullable();
            $table->string('news_lang_code')->default('en');
            $table->tinyInteger('IsDelete')->default(0);
            $table->unsignedInteger('news_categories_id');
            $table->foreign('news_categories_id')->references('id')->on('news_categories');
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
        Schema::dropIfExists('news');
    }
}
