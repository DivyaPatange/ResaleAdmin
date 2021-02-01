<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use HasFactory;

    protected $table = "models";

    protected $fillable = ['brand_id', 'model_name', 'status', 'category_id', 'sub_category_id'];

    public function brands(){
        return $this->hasMany('App\Models\Admin\Brand','brand_id', 'id');
    }
}
