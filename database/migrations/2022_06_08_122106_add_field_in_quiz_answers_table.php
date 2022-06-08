<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldInQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_answers', function (Blueprint $table) {
            $table->tinyInteger('is_right')->default('0')->comment('1 = Right, 0 = Wrong')->after('position');
            // $table->text('hint')->after('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_answers', function (Blueprint $table) {
            $table->dropColumn('is_right');
        });
    }
}