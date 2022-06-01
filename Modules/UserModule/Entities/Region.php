<?php

namespace Modules\UserModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar','name_en','goverment_id'];
    protected static function newFactory()
    {
        return \Modules\UserModule\Database\factories\RegionFactory::new();
    }


    public function government()
    {
        return $this->belongsTo(Government::class, 'goverment_id');
    }
}
