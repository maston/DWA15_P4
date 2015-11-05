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
            $table->integer('grocery_run_id');
            $table->integer('user_id');
            $table->date('dt_meal_count');
            $table->integer('bfast_ct');
            $table->integer('lunch_ct');
            $table->integer('dinner_ct');
            $table->integer('coffee_ct');
            $table->boolean('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meal_count_days');
    }
}
