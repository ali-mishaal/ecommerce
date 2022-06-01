<?php

namespace Modules\TransferModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleType extends Model
{

    protected $fillable = ['name_ar','name_en'];
}
