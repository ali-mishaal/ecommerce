<?php

namespace Modules\UserModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supervisor extends Model
{

    protected $fillable = ['created_by'];
    protected $with=['user'];
    public function user()
    {
        return $this->morphOne(User::class, 'user')->where('user_type',Supervisor::class);
    }
}
