<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRole extends Model
{
    use HasFactory;

    protected $table = "sub_roles";

    protected $fillable = ['sub_role', 'role_id', 'status'];

    public function roles(){
        return $this->belongsTo('App\Models\Admin\Role','role_id', 'id');
    }
}
