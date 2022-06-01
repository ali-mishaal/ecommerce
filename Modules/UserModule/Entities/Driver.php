<?php

namespace Modules\UserModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\OrderModule\Entities\Order;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ['has_sallary','sallary','has_commission','commission','has_company_vehicle','company_vehicle_id', 'company_moto_id', 'has_moto'];

    protected $with=['user'];

    /**
     * @return MorphOne
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'user')->where('user_type',Driver::class);
    }

    /**
     * @return BelongsToMany
     */

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * @return BelongsToMany
     */

    public function assignedOrders(): BelongsToMany
    {
        return $this->orders()->where('driver_approved', true);
    }
}
