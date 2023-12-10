<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('customers', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('slug');
//            $table->string('name');
//            $table->string('email')->nullable();
//            $table->string('phone')->nullable();
//            $table->string('contact_person')->nullable();
//            $table->boolean('type');
//            $table->text('description')->nullable();
//
//            $table->boolean('save_contract')->nullable();
//            $table->longText('contract')->nullable();
//
//            $table->boolean('contract_number')->nullable();
//            $table->integer('contract_date')->nullable();
//            $table->boolean('ltd')->nullable();
//            $table->string('director')->nullable();
//            $table->string('director_case')->nullable();
//            $table->string('address')->nullable();
//            $table->string('ogrn')->nullable();
//            $table->string('okpo')->nullable();
//            $table->string('okved')->nullable();
//            $table->string('oktmo')->nullable();
//            $table->string('inn')->nullable();
//            $table->string('kpp')->nullable();
//            $table->string('payment_account')->nullable();
//            $table->string('correspondent_account')->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('customers');
    }
}
