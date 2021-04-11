<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = "cars";

    protected $fillable = ['user_id', 'sub_category_id','brand_id', 'model_id', 'price', 'year_of_registration', 'fuel_type', 'transmission', 'kms_driven', 'no_of_owners', 'ad_title', 'description', 'photos', 'state_id', 'city_id', 'pin_code', 'address', 'name', 'email', 'mobile_no', 'car_varient', 'colour', 'insurance', 'locality_id'];
}
