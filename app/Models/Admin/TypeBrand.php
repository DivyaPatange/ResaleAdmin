<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeBrand extends Model
{
    use HasFactory;

    protected $table = "type_brands";

    protected $fillable = ['type_id', 'type_brand_name', 'status', 'category_id', 'sub_category_id'];

    public function types(){
        return $this->belongsTo('App\Models\Admin\Type','type_id', 'id');
    }
}
