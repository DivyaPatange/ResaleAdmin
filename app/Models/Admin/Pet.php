<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = "pets";

    protected $fillable = ['user_id', 'category_id', 'sub_category_id', 'type_id', 'ad_title', 'description', 'photos', 'price', 'name', 'email', 'mobile_no', 'state_id', 'city_id', 'locality_id', 'pin_code', 'address', 'user_type', 'gst_no'];
}
