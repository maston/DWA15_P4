<?php

use Illuminate\Database\Seeder;

class GroceryRunsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = \LMG\User::where('name','=','maston')->pluck('id');
        //$user_id = 1;
        DB::table('grocery_runs')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'user_id' => $user_id,
        'dt_grocery_run' => '2015-01-01',
        'total_amt' => 100.00,
        'food_amt' => 80,
        'non_food_amt' => 20,
        ]);
        DB::table('grocery_runs')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'user_id' => $user_id,
        'dt_grocery_run' => '2015-01-08',
        'total_amt' => 50.00,
        'food_amt' => 45,
        'non_food_amt' => 5,
        ]);
        DB::table('grocery_runs')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'user_id' => $user_id,
        'dt_grocery_run' => '2015-01-17',
        'total_amt' => 60.00,
        'food_amt' => 50,
        'non_food_amt' => 10,
        ]);
    }
}
