<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Андрей',
            'email' => 'a@g.ru',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Влад',
            'email' => 'v@m.ru',
            'password' => Hash::make('123456'),
        ]);
    }
}
