<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PGHouse extends Model
{
    use HasFactory;

    protected $table = "p_g_houses";

    protected $fillable = ['locality', 'address', 'pin_code', 'landmark', 'pg_operational_since', 'pg_present_in', 'pg_name',
    'ad_posted_by', 'rooms_categories', 'no_of_single_sharing_room', 'mo_rent_p_bed_single', 'security_deposit_single', 'no_of_double_sharing_room',
    'mo_rent_p_bed_double', 'security_deposit_double', 'no_of_triple_sharing_room', 'mo_rent_p_bed_triple', 'security_deposit_triple',
    'no_of_four_sharing_room', 'mo_rent_p_bed_four', 'security_deposit_four', 'no_of_other_sharing_room', 'mo_rent_p_bed_other',
    'security_deposit_other', 'room_facility', 'preferred_gender', 'tenent_preference', 'pg_rules', 'notice_period', 'gate_closing_time',
    'available_services', 'food_provided', 'amenities', 'parking_availability', 'pg_description', 'photos'];
}
