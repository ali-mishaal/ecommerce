<?php

namespace Modules\UserModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','government','region','widget','street','avenue','home_number','floor','flat','status'];

    public function governmentt()
    {
        return $this->belongsTo(Government::class,'government');
    }

    public function regionn()
    {
        return $this->belongsTo(Region::class,'region');
    }
    protected static function newFactory()
    {
        return \Modules\UserModule\Database\factories\UserAddressFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
