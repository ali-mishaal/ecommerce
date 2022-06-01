<?php

namespace Modules\TransferModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CommonModule\Entities\CompanyVehicle;
use Modules\UserModule\Entities\Driver;

class DriverVehicle extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'request_type',
        'request_id'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(CompanyVehicle::class,'vehicle_id');
    }


}
