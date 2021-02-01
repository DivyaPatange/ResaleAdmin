<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table ="brands";

    protected $fillable = ['brand_name', 'status', 'category_id', 'sub_category_id'];

    public function model_name(){
        return $this->belongsTo('App\Models\Admin\ModelName','brand_name', 'id');
    }
}
