<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('tasks', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//            $table->string('email')->nullable();
//            $table->string('phone')->nullable();
//            $table->string('contact_person')->nullable();
//            $table->integer('value');
//            $table->integer('paid_off');
//            $table->integer('percents')->nullable();
//            $table->integer('my_percent')->nullable();
//            $table->integer('paid_percents')->nullable();
//            $table->boolean('use_duty')->nullable();
//            $table->boolean('status');
//            $table->integer('start_time');
//            $table->integer('completion_time');
//            $table->integer('payment_time')->nullable();
//            $table->text('description')->nullable();
//
//            $table->integer('convention_number')->nullable();
//            $table->integer('convention_date')->nullable();
//            $table->boolean('save_convention')->nullable();
//            $table->longText('convention')->nullable();
//            $table->boolean('tax_type');
//
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
//        Schema::dropIfExists('tasks');
    }
}
