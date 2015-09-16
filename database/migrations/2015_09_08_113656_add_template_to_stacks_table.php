<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTemplateToStacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stacks', function (Blueprint $table) {
            $table->integer('template_id')->after('slug')->nullable()->unsigned();
            $table->foreign('template_id')->references('id')->on('stack_templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stacks', function (Blueprint $table) {
            $table->dropForeign('stacks_template_id_foreign');
            $table->dropColumn('template_id');
        });
    }
}
