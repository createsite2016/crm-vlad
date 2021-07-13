<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Администратор',
            'value' => 0
        ]);
        DB::table('roles')->insert([
            'name' => 'Оператор',
            'value' => 1
        ]);
        DB::table('roles')->insert([
            'name' => 'Исполнитель',
            'value' => 2
        ]);
    }
}
