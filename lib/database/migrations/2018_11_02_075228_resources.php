<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Resources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resources_title')->nullable();
            $table->string('resources_description')->nullable();
            $table->string('resources_path')->nullable();
            $table->string('resources_thumb')->nullable();
            $table->string('resources_type')->nullable();
            $table->string('resources_lang_code')->default('en');
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
        Schema::dropIfExists('resources');
    }
}
