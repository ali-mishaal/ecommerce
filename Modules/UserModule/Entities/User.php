<?php

namespace Modules\UserModule\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, HasFactory, HasRoles, Notifiable;

    protected $fillable = ['name','civil_id','status','address','mobile','phone','image','username','password','user_id','user_type'];
    protected $appends = ['role_id', 'supervisor_image_path', 'image_path'];
    protected static function newFactory()
    {
        return \Modules\UserModule\Database\factories\UserFactory::new();
    }

    protected $hidden = [
        'password',
    ];
    protected $guard_name = 'web';

    public function getEditUrlAttribute()
    {
        return url('admin/'.$this->id.'/edit');
    }
    public function getRoleIdAttribute()
    {
        return $this->roles() && $this->roles()->first()?$this->roles()->first()->id:0;
    }

    public function getSupervisorImagePathAttribute()
    {
        return asset('images/supervisors/' . $this->image);
    }

    public function getImagePathAttribute()
    {
        switch ($this->user_type){
            case null;
            $folder = 'admins';
            break;

            case Supervisor::class;
            $folder = 'supervisors';
            break;

            case Driver::class;
            $folder = 'drivers';
            break;

            case Client::class;
            $folder = 'clients';
            break;

            default;
            $folder = '';
        }

        return asset('images/' . $folder . '/' . $this->image);
    }
}
