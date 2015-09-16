<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackTiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_tiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('signups_required');
            $table->text('image')->nullable();
            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stacks');
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
        Schema::table('stack_tiers', function (Blueprint $table) {
            $table->dropForeign('stack_tiers_stack_id_foreign');
        });
        Schema::drop('stack_tiers');
    }
}
