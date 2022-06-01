<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\OrderModule\Database\Seeders\OrderStatusTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(OrderStatusTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
    }
}
