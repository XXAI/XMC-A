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
            'clues' => 'CSSSA017213',
            'password' => bcrypt('secret'),
        ]);
    }
}
