<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'acc_type', 'role_access',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('acc_type', $roles)->first())
        {
            return true;
        }
        return false;
    }
    
    public function hasRole($role)
    {
        if($this->roles()->where('acc_type', $role)->first())
        {
            return true;
        }
        return false;
    }
}
