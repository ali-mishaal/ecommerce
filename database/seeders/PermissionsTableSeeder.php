<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
       \DB::table('permissions')->truncate();
       \DB::table('role_has_permissions')->truncate();
       \Schema::enableForeignKeyConstraints();

       $routes = app()->routes->getRoutes();
       $arr = [];

       foreach ($routes as $route)
       {

           $route_name = $route->getName();
           if ($route_name != null && !Str::is('debugbar*', $route_name) && !Str::is('LaravelInstaller*', $route_name) && !Str::is('LaravelUpdater*', $route_name))
           $arr[] = [
               'name' => $route_name,
               'guard_name' => 'web',
               'title_en' => explode('.', $route_name)[0],
               'title_ar' => explode('.', $route_name)[0],
           ];
       }

       \DB::table('permissions')->insert($arr);
    }
}
