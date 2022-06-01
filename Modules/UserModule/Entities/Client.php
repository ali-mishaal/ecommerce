<?php

namespace Modules\UserModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['activity','project_data','payment_type_id','limit','payment_method_id','fees','bank_account'];

    protected $with=['user'];
    public function user()
    {
        return $this->morphOne(User::class, 'user')->where('user_type',Client::class);
    }
}
