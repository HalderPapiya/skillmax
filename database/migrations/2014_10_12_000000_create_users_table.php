<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fName');
            $table->string('lName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('college');
            $table->string('subject');
            $table->string('passing_year')->nullable();
            $table->string('dob')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('prime_status')->default('1')->comment('1 = Enrolled, 0 = Not Enrolled');
            $table->string('expire_date')->nullable();
            $table->string('certificate')->nullable();
            $table->tinyInteger('subscribe_to_newsletter')->default('0')->comment('1 = Yes, 0 = No');
            $table->tinyInteger('study_abroad')->default('0')->comment('1 = Yes, 0 = No');
            $table->tinyInteger('agree_term_condition')->default('0')->comment('1 = Yes, 0 = No');
            $table->string('resume')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default('1')->comment('1 = Active, 0 = Inactive');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}