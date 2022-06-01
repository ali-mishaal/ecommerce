<?php

namespace Modules\OrderModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\UserModule\Entities\Client;
use Modules\UserModule\Entities\Government;
use Modules\UserModule\Entities\Region;
use Modules\UserModule\Entities\User;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'address_name',
        'government_id',
        'region_id',
        'widget',
        'street',
        'avenue',
        'home_number',
        'floor',
        'flat'
    ];

    protected static function newFactory()
    {
        return \Modules\OrderModule\Database\factories\CustomerFactory::new();
    }


    public function government(): BelongsTo
    {
        return $this->belongsTo(Government::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'user')->where('user_type',Customer::class);
    }

}
