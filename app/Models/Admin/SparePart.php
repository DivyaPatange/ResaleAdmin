<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    protected $table = "spare_parts";
    protected $fillable = ['user_id', 'sub_category_id', 'type_id', 'ad_title', 'description', 'photos', 'price',
    'name', 'email', 'mobile_no', 'state_id', 'city_id', 'locality_id', 'pin_code', 'address'];
}
