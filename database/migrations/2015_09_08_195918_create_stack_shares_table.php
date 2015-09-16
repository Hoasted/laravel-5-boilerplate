<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->index();
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('stack_members');
            $table->string('ip', 45);
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
        Schema::table('stack_shares', function (Blueprint $table) {
            $table->dropForeign('stack_shares_member_id_foreign');
        });
        Schema::drop('stack_shares');
    }
}
