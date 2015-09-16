<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFbidToStackMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stack_members', function (Blueprint $table) {
            $table->string('fb_id')->nullable()->after('locale');
            $table->string('fb_accesstoken')->nullable()->after('fb_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stack_members', function (Blueprint $table) {
            $table->dropColumn('fb_id');
        });
    }
}
