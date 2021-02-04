<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVarient extends Model
{
    use HasFactory;

    protected $table = "car_varients";

    protected $fillable = ['category_id', 'sub_category_id', 'brand_id', 'model_id', 'car_varient'];

    public function brands(){
        return $this->belongsTo('App\Models\Admin\Brand','brand_id', 'id');
    }

    public function model_name(){
        return $this->belongsTo('App\Models\Admin\ModelName','model_id', 'id');
    }
}
