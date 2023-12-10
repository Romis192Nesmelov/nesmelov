<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('bills', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('number');
//            $table->integer('date');
//            $table->integer('signing');
//            $table->boolean('status');
//            $table->boolean('send_email');
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
//        Schema::dropIfExists('bills');
    }
}