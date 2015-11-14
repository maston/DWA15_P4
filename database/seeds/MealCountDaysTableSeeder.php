<?php

use Illuminate\Database\Seeder;

class MealCountDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = \LMG\User::where('name','=','maston')->pluck('id');
        $grocery_run_id = \LMG\GroceryRun::where('dt_grocery_run','=','2015-01-01')->pluck('id');
        //$user_id = 1;
        DB::table('meal_count_days')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'grocery_run_id' => $grocery_run_id,
        'user_id' => $user_id,
        'dt_meal_count' => '2015-01-01',
        'bfast_ct' => 2,
        'lunch_ct' => 1,
        'dinner_ct' => 2,
        'coffee_ct' => 3,
        ]);
        DB::table('meal_count_days')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'grocery_run_id' => $grocery_run_id,
        'user_id' => $user_id,
        'dt_meal_count' => '2015-01-02',
        'bfast_ct' => 0,
        'lunch_ct' => 1,
        'dinner_ct' => 1,
        'coffee_ct' => 4,
        ]);
        DB::table('meal_count_days')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'grocery_run_id' => $grocery_run_id,
        'user_id' => $user_id,
        'dt_meal_count' => '2015-01-03',
        'bfast_ct' => 1,
        'lunch_ct' => 0,
        'dinner_ct' => 1,
        'coffee_ct' => 1,
        ]);
    }
}
