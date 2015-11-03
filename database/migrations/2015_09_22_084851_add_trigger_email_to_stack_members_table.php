<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTriggerEmailToStackMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stack_members', function (Blueprint $table) {
            $table->boolean('trigger_email_send')->default(false)->after('is_valid_signup_ip');
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
             $table->dropColumn('trigger_email_send');
        });
    }
}
