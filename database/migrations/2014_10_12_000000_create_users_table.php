<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('zipcode', 5)->default('00000');
            $table->decimal('bfast_spend')->default(5);
            $table->decimal('lunch_spend')->default(10);
            $table->decimal('dinner_spend')->default(20);
            $table->decimal('coffee_spend')->default(2.5);
            $table->rememberToken();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
