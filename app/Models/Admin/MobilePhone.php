<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilePhone extends Model
{
    use HasFactory;

    protected $table = "mobile_phones";

    protected $fillable = ['user_id', 'sub_category_id', 'brand_id', 'model_id', 'year_of_purchase',
    'physical_condition', 'ad_title', 'description', 'photos', 'price', 'name', 'email', 'mobile_no',
    'state_id', 'city_id', 'locality_id', 'pin_code', 'address', 'user_type', 'firm_name', 'gst_no',
    'invoice', 'additional_accessory', 'damages_and_functional_issues'];
}
