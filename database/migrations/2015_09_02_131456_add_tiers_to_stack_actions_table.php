<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTiersToStackActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stack_actions', function (Blueprint $table) {
            $table->integer('tier_id')->unsigned()->nullable()->after('integration_id');
            $table->foreign('tier_id')->references('id')->on('stack_tiers');
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
            $table->dropForeign('stack_actions_tier_id_foreign');
            $table->dropColumn('tier_id');
        });
    }
}
