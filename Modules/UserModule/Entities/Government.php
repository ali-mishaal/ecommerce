<?php

namespace Modules\UserModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Government extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar','name_en'];

    protected static function newFactory()
    {
        return \Modules\UserModule\Database\factories\GovernmentFactory::new();
    }

    public function regions()
    {
        return $this->hasMany(Region::class, 'goverment_id');
    }
}
