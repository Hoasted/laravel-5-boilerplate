<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_ips', function (Blueprint $table) {
            $table->string('ip', 45);
            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stacks');
            $table->integer('signups')->unsigned()->default(0);
            $table->timestamps();
            $table->primary(['ip', 'stack_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stack_ips', function (Blueprint $table) {
            $table->dropForeign('stack_ips_stack_id_foreign');
        });
        Schema::drop('stack_ips');
    }
}
