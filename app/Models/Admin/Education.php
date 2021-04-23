<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = "education";

    protected $fillable = ['category_id', 'sub_category_id', 'user_id', 'ad_title', 'description', 'photos', 'fees', 'institute_website', 'education_stream', 'institute_name',
    'institute_address', 'name', 'email', 'mobile_no', 'state_id', 'city_id', 'locality_id', 'pin_code', 'address', 'user_type', 'gst_no'];
}
