<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealCountDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('meal_count_days', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('grocery_run_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('dt_meal_count');
            $table->integer('bfast_ct')->default(0);
            $table->integer('lunch_ct')->default(0);
            $table->integer('dinner_ct')->default(0);
            $table->integer('coffee_ct')->default(0);
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('grocery_run_id')->references('id')->on('grocery_runs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meal_count_days', function (Blueprint $table) {
            # ref: http://laravel.com/docs/5.1/migrations#dropping-indexes
            $table->dropForeign('meal_count_days_user_id_foreign');
            $table->dropForeign('meal_count_days_grocery_run_id_foreign');
        });
        Schema::drop('meal_count_days');
    }
}
