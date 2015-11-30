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
        $user = \LMG\User::firstOrCreate(['email' => 'maston@pantomath.com']);
        $user->name = 'maston';
        $user->email = 'maston@pantomath.com';
        $user->password = \Hash::make('abc123');
        $user->save();

        $user = \LMG\User::firstOrCreate(['email' => 'jill@harvard.edu']);
        $user->name = 'Jill';
        $user->email = 'jill@harvard.edu';
        $user->password = \Hash::make('helloworld');
        $user->save();

        $user = \LMG\User::firstOrCreate(['email' => 'jamal@harvard.edu']);
        $user->name = 'Jamal';
        $user->email = 'jamal@harvard.edu';
        $user->password = \Hash::make('helloworld');
        $user->save();
    }
}
