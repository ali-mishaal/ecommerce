<?php

namespace Modules\CommonModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\TransferModule\Entities\Brand;
use Modules\TransferModule\Entities\DriverVehicle;
use Modules\TransferModule\Entities\VehicleType;
use Modules\UserModule\Entities\Driver;

class CompanyVehicle extends Model
{
    use HasFactory;

    protected $fillable = ['brand','color','vehicle_number','type','system_number','km_number', 'is_moto'];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand');
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class,'type');
    }

    public function driver()
    {
        return $this->belongsToMany(Driver::class, 'driver_vehicles', 'vehicle_id', 'driver_id');
    }


}
