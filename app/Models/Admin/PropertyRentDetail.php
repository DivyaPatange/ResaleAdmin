<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRentDetail extends Model
{
    use HasFactory;

    protected $table = "property_rent_details";

    protected $fillable = ['rent_id', 'ac', 'bed', 'wardrobe', 'tv', 'furnished_detail', 'covered_no', 'open_no', 'name', 'email', 'mobile_no', 'user_state', 'user_city', 'user_locality', 'address', 'pin_code'];
}
