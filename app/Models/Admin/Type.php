<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = "types";

    protected $fillable = ['type_name', 'status', 'category_id', 'sub_category_id'];

    public function type_brand(){
        return $this->hasMany('App\Models\Admin\TypeBrand','type_id', 'id');
    }

    public function type_size(){
        return $this->hasMany('App\Models\Admin\Size','type_id', 'id');
    }
}
