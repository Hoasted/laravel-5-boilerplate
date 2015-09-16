<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stack_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('referral_token')->unique();
            $table->string('referred_by')->nullable();
            $table->boolean('is_valid_signup_ip');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('locale')->nullable();
            $table->string('ip', 45);
            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stacks');
            $table->timestamps();
            $table->index('email');
            $table->index('referral_token');
            $table->index('referred_by');
            $table->index('ip');
            $table->index('is_valid_signup_ip');
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
            $table->dropForeign('stack_members_stack_id_foreign');
        });
        Schema::drop('stack_members');
    }
}
