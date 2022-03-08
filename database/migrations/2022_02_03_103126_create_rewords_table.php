<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRewordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time');
            $table->float('amount', 5, 2);
            $table->softDeletes();
            $table->tinyInteger('status')->default('1')->comment('1 = Active, 0 = Inactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            [
                'time' => 'New Joining',
                'amount' => '50',
            ],
            [
                'time' => 'Referral',
                'amount' => '100',
            ],
        ];
        DB::table('rewords')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewords');
    }
}