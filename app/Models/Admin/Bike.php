<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $table = "bikes";

    protected $fillable = ['user_id', 'sub_category_id', 'brand_id', 'model_id', 'year_of_registration',
    'kms_driven', 'ad_title', 'description', 'photos', 'price', 'name', 'email', 'mobile_no',
    'state_id', 'city_id', 'locality_id', 'pin_code', 'address'];
}
