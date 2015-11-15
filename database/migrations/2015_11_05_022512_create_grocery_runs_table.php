<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroceryRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grocery_runs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->date('dt_grocery_run');
            $table->integer('total_amt')->default(0);
            $table->integer('food_amt')->default(0);
            $table->integer('non_food_amt')->default(0);
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grocery_runs', function (Blueprint $table) {
            # ref: http://laravel.com/docs/5.1/migrations#dropping-indexes
            $table->dropForeign('grocery_runs_user_id_foreign');
        });
        Schema::drop('grocery_runs');
    }
}
