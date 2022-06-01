<?php

namespace Modules\OrderModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\UserModule\Entities\Client;
use Modules\UserModule\Entities\Driver;
use Modules\UserModule\Entities\Government;
use Modules\UserModule\Entities\Region;
use Modules\UserModule\Entities\Supervisor;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'supervisor_id',
        'new_supervisor_id',
        'driver_id',
        'new_driver_id',
        'driver_approved',
        'status_id',

        'address',
        'mobile',
        'amount',
        'amount_taken_by',
        'order_fees',
        'order_fees_taken_by',
        'company_fees',
        'driver_fees',
        'is_urgent',
        'delivery_time',
        'customer_mobile',
        'customer_name',

        'is_from_client',
        'description',
        'address_name',
        'government',
        'region',
        'widget',
        'street',
        'avenue',
        'home_number',
        'floor',
        'flat',
        'caddress_name',
        'cgovernment',
        'cregion',
        'cwidget',
        'cstreet',
        'cavenue',
        'chome_number',
        'cfloor',
        'cflat'
    ];

    protected static function newFactory()
    {
        return \Modules\OrderModule\Database\factories\OrderFactory::new();
    }

    public function getReceivingTimeAttribute()
    {
        return $this->is_urgent ? 'Urgent' : 'Postpone';
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id')->with('user');
    }

    public function new_supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'new_supervisor_id')->with('user');
    }


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->with('user');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id')->with('user');
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function governmentRel()
    {
        return $this->belongsTo(Government::class, 'government');
    }

    public function regionn()
    {
        return $this->belongsTo(Region::class, 'region');
    }

    public function cregionn()
    {
        return $this->belongsTo(Region::class, 'cregion');
    }

    public function cgovernmentRel()
    {
        return $this->belongsTo(Government::class, 'cgovernment');
    }
}
