<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_integrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stacks');
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
        Schema::table('stack_integrations', function (Blueprint $table) {
            $table->dropForeign('stack_integrations_stack_id_foreign');
        });
        Schema::drop('stack_integrations');
    }
}
