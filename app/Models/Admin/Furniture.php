<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    use HasFactory;

    protected $table = "furniture";

    protected $fillable = ['user_id', 'sub_category_id','type_id', 'type_brand_id','condition', 'age',
    'ad_title', 'description', 'photos', 'price', 'name', 'email', 'mobile_no','state_id', 'city_id', 'locality_id',
    'pin_code', 'address', 'user_type', 'gst_no'];
}
