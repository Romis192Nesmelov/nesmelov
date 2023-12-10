<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('works', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//            $table->string('description');
//            $table->string('full')->nullable();
//            $table->string('preview');
//            $table->string('url')->nullable();
//            $table->boolean('active');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('works');
    }
}
