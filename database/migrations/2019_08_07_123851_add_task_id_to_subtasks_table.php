<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskIdToSubtasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('sub_tasks', function (Blueprint $table) {
//            $table->integer('task_id', false, true);
//            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('sub_tasks', function (Blueprint $table) {
//            $table->dropForeign('sub_tasks_task_id_foreign');
//            $table->dropColumn('task_id');
//        });
    }
}
