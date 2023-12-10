<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubTaskIdToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('messages', function (Blueprint $table) {
//            $table->integer('sub_task_id', false, true)->nullable();
//            $table->foreign('sub_task_id')->references('id')->on('sub_tasks')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('messages', function (Blueprint $table) {
//            $table->dropForeign('messages_sub_task_id_foreign');
//            $table->dropColumn('sub_task_id');
//        });
    }
}
