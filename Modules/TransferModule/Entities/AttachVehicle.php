<?php

namespace Modules\TransferModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CommonModule\Entities\CompanyVehicle;
use Modules\UserModule\Entities\Driver;

class AttachVehicle extends Model
{
    use HasFactory, SoftDeletes;

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

        'created_by_id',
        'created_by_type',
    ];

    protected static function newFactory()
    {
        return \Modules\TransferModule\Database\factories\AttachVehicleFactory::new();
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
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
        if($this->driver_status && $this->supervisor_status)
        {
            DriverVehicle::create([
                'driver_id' => $this->driver_id,
                'vehicle_id' => $this->vehicle_id,
                'request_id' => $this->id,
                'request_type' => AttachVehicle::class,
            ]);
        }
    }
}
