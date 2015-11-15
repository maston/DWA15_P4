<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'name' => 'maston',
        'email' => 'maston@pantomath.com',
        'password' => 'abc123',
        'zipcode' => '12345',
        ]);
        DB::table('users')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'name' => 'jill',
        'email' => 'jill@harvard.edu',
        'password' => 'abc123',
        'zipcode' => '12345',
        ]);
    }
}
