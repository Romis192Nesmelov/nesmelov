<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('news', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('slug');
//            $table->string('image')->nullable();
//            $table->string('head');
//            $table->string('short');
//            $table->text('text');
//            $table->integer('time');
//            $table->boolean('active');
//            $table->boolean('important');
////            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('news');
    }
}
