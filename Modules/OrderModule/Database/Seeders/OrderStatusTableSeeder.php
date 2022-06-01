<?php

namespace Modules\OrderModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\OrderModule\Entities\OrderStatus;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $arr = [
            [
                'name_ar' => 'new',
                'name_en' => 'new',
                'driver_can_edit' => false,
            ],
            [
                'name_ar' => 'pending',
                'name_en' => 'pending',
                'driver_can_edit' => false,
            ],
            [
                'name_ar' => 'driver approved',
                'name_en' => 'driver approved',
                'driver_can_edit' => true,
            ],
            [
                'name_ar' => 'shipped',
                'name_en' => 'shipped',
                'driver_can_edit' => true,
            ],
            [
                'name_ar' => 'canceled',
                'name_en' => 'canceled',
                'driver_can_edit' => true,
            ],
            [
                'name_ar' => 'reschedule',
                'name_en' => 'reschedule',
                'driver_can_edit' => true,
            ],
            [
                'name_ar' => 'delivered',
                'name_en' => 'delivered',
                'driver_can_edit' => true,
            ],
        ];


        (new OrderStatus)->insert($arr);

        // $this->call("OthersTableSeeder");
    }
}
