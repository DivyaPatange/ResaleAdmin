<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $fillable = ['role_name', 'status'];

    public function sub_role(){
        return $this->hasMany('App\Models\Admin\SubRole','role_id', 'id');
    }
}
