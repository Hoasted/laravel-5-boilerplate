<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stacks');
            $table->integer('integration_id')->unsigned();
            $table->foreign('integration_id')->references('id')->on('stack_integrations');
            $table->string('type');
            $table->text('config');
            $table->boolean('is_enabled');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stack_actions', function (Blueprint $table) {
            $table->dropForeign('stack_actions_integration_id_foreign');
            $table->dropForeign('stack_actions_stack_id_foreign');
        });
        Schema::drop('stack_actions');
    }
}
