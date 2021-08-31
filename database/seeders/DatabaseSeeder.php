<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(1)->create();
        $user = new UserSeeder();
        $user->run();

        $role = new RoleSeeder();
        $role->run();

        $city = new CitySeeder();
        $city->run();
    }
}
