<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stacks');
            $table->string('key')->index();
            $table->text('meta');
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
        Schema::table('stack_contents', function (Blueprint $table) {
            $table->dropForeign('stack_contents_stack_id_foreign');
        });
        Schema::drop('stack_contents');
    }
}
