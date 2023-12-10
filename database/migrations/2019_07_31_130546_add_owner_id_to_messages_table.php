<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerIdToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('messages', function (Blueprint $table) {
//            $table->integer('owner_id', false, true);
//            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
//            $table->dropForeign('messages_owner_id_foreign');
//            $table->dropColumn('owner_id');
//        });
    }
}
