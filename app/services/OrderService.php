<?php

namespace App\services;

use App\Exceptions\CannotCreateClientException;
use Modules\CommonModule\Entities\PaymentMethod;
use Modules\CommonModule\Entities\PaymentType;
use Modules\OrderModule\Entities\Customer;
use Modules\UserModule\Entities\Client;
use Modules\UserModule\Entities\Driver;

class OrderService
{
    private static $limit = 5;

    public function supervisorChangeDriver($order, $new_driver_id)
    {
        $order->driver_id = $new_driver_id;
        $order->driver_approved = false;
        $order->status_id = 2;
        $order->save();
    }


    public function driverApproveOrder($order, $id)
    {
        $driver = Driver::find($id);
        $order->new_driver_id = null;
        $order->driver_id = $driver->id;
        $order->status_id = 3;
        $order->driver_approved = true;
        $order->drivers()->detach();
        $order->save();
    }

    public function calculateOrderFees($order, $driver)
    {
        $order->driver_fees = round($driver->commission * $order->order_fees / 100, 2);
        $order->company_fees = $order->fees - $order->driver_fees;
        $order->save();
    }


    public function getSelect2Query($query, $search, $page, $with_user = true)
    {

        if ($search)
        {
            if ($with_user)
            {

                $query = $query
                    ->whereHas('user', function ($q) use($search) {
                        return $q->where('name', 'like', '%'. $search .'%');
                    })
                    ->orWhereHas('user', function ($q) use($search) {
                        return $q->where('mobile', 'like', '%' . $search . '%');
                    });
            }else
            {
                $query = $query
                    ->where('name', 'like', '%'. $search .'%')
                    ->orWhere('mobile', 'like', '%' . $search . '%');
            }
        }

        $limit = OrderService::$limit;
        $skip = ($page - 1) * $limit;

        return $query->skip($skip)->take($limit);

    }


    public function select2Paginate($count, $page = 0)
    {
        $limit = OrderService::$limit;

        $skip = ($page - 1) * $limit;

        return $count - $skip > $limit;
    }


    // shouldn't be in order service
    public function createCustomer($request)
    {
        $customer = [
            'name' => $request->customer_name,
            'mobile' => $request->customer_mobile,
            'government_id' => $request->cgovernment,
            'region_id' => $request->cregion,
            'widget' => $request->cwidget,
            'street' => $request->cstreet,
            'avenue' => $request->cavenue,
            'home_number' => $request->chome_number,
            'floor' => $request->cfloor,
            'flat' => $request->cflat
        ];

        Customer::create($customer);
    }


    // shouldn't be in order service

    /**
     * @throws CannotCreateClientException
     */
    public function createNewClient($name, $phone)
    {

        \DB::beginTransaction();
        try {

            $client = Client::create([
                'payment_type_id' => PaymentType::first()->id,
                'payment_method_id' => PaymentMethod::first()->id,
                'fees'             => '0',
            ]);

            $client->user()->create([
                'name'      => $name,
                'mobile'    => $phone,
                'status'    => 1,
            ]);

            \DB::commit();
            return $client->id;

        }catch (\Exception $e){
            \DB::rollBack();
            throw new CannotCreateClientException('can\'t  Create Client');
        }
    }
}
