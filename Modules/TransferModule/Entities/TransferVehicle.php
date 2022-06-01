<?php

namespace Modules\TransferModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CommonModule\Entities\CompanyVehicle;
use Modules\UserModule\Entities\Driver;

class TransferVehicle extends Model
{

    protected $fillable = [
        'vehicle_id',
        'driver_id',

        'request_vehicle_image',
        'request_km_image',
        'request_km',
        'request_note',
        'supervisor_status',

        'driver_plate_image',
        'driver_plate_image',
        'driver_status',

        'old_driver_id',
        'old_driver_status',

        'created_by_id',
        'created_by_type',

        'deduction'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }

    public function oldDriver()
    {
        return $this->belongsTo(Driver::class,'old_driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(CompanyVehicle::class,'vehicle_id');
    }

    public function creator()
    {
        return $this->morphTo();
    }

    public function onApprove()
    {
        if($this->driver_status && $this->supervisor_status && $this->old_driver_status)
        {
            $driverVehicle = DriverVehicle::where([
                'driver_id'     => $this->old_driver_id,
                'vehicle_id'    => $this->vehicle_id
            ])->first();

            $driverVehicle->update([
                'driver_id' => $this->driver_id,
                'request_id' => $this->id,
                'request_type' => AttachVehicle::class,
            ]);
        }
    }
}
