<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_action_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('action_id')->unsigned();
            $table->foreign('action_id')->references('id')->on('stack_action_logs');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('stack_members');
            $table->boolean('has_run')->default(false);
            $table->timestamp('ran_on')->nullable();
            $table->index('has_run');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stack_action_logs', function (Blueprint $table) {
            $table->dropForeign('stack_action_logs_action_id_foreign');
            $table->dropForeign('stack_action_logs_member_id_foreign');
        });
        Schema::drop('stack_action_logs');
    }
}
