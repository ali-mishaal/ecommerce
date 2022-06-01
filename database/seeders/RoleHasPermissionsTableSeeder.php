<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Schema::disableForeignKeyConstraints();
        \DB::table('role_has_permissions')->truncate();
        \Schema::enableForeignKeyConstraints();
        $permissions = Permission::all();
        $arr = [];
        foreach ($permissions as $permission)
        {

            $arr = array_merge($arr, [
                [
                    'permission_id' => $permission->id,
                    'role_id'       => 1
                ],
                [
                    'permission_id' => $permission->id,
                    'role_id'       => 2
                ],
            ]);
        }

        $driver_permissions = [
            [
                "permission_id" => 1,
                "role_id" => 3
            ],
            [
                "permission_id" => 9,
                "role_id" => 3
            ],
            [
                "permission_id" => 12,
                "role_id" => 3
            ],
            [
                "permission_id" => 21,
                "role_id" => 3
            ],
            [
                "permission_id" => 22,
                "role_id" => 3
            ],
            [
                "permission_id" => 23,
                "role_id" => 3
            ],
            [
                "permission_id" => 24,
                "role_id" => 3
            ],
            [
                "permission_id" => 25,
                "role_id" => 3
            ],
            [
                "permission_id" => 26,
                "role_id" => 3
            ],
            [
                "permission_id" => 27,
                "role_id" => 3
            ],
            [
                "permission_id" => 41,
                "role_id" => 3
            ],
            [
                "permission_id" => 42,
                "role_id" => 3
            ],
            [
                "permission_id" => 43,
                "role_id" => 3
            ],
            [
                "permission_id" => 44,
                "role_id" => 3
            ],
            [
                "permission_id" => 49,
                "role_id" => 3
            ]
        ];

        $arr = array_merge($arr, $driver_permissions);
        \DB::table('role_has_permissions')->insert($arr);
    }
}
