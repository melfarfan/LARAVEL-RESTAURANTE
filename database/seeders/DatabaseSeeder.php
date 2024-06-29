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
    public function run() //Aquí se  deben registrar todos los seeders
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
