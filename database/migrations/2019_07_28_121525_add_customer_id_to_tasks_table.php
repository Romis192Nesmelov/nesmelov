<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerIdToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('tasks', function (Blueprint $table) {
//            $table->integer('customer_id', false, true);
//            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('tasks', function (Blueprint $table) {
//            $table->dropForeign('tasks_customer_id_foreign');
//            $table->dropColumn('customer_id');
//        });
    }
}
