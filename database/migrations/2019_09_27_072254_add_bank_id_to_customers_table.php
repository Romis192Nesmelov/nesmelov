<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankIdToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('customers', function (Blueprint $table) {
//            $table->integer('bank_id', false, true)->nullable();
//            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('customers', function (Blueprint $table) {
//            $table->dropForeign('customers_bank_id_foreign');
//            $table->dropColumn('bank_id');
//        });
    }
}
