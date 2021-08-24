<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRent extends Model
{
    use HasFactory;

    protected $table = "property_rents";

    protected $fillable = ['user_id', 'category_id', 'sub_category_id', 'type_id', 'city', 'locality', 'address', 'project_name', 'bedroom',
    'balcony', 'bathroom', 'property_floor_no', 'total_floor', 'furnished_status', 'super_area', 'super_unit', 'carpet_area', 'carpet_unit', 
    'build_area', 'build_unit', 'available_from', 'available_date', 'age_of_construction', 'monthly_rent', 'rent_as', 'other_charges', 'elec_water_charges',
    'security_amount', 'maintenance_charges', 'charges_per', 'brokerages', 'exterior_photos', 'living_room_photos', 'bedroom_photos', 'bathroom_photos',
    'kitchen_photos', 'tenants_bachelor', 'tenants_non_veg', 'tenants_pets', 'tenants_company_lease', 'add_rooms', 'facing', 'overlooking', 'car_parking',
    'lifts_in_tower', 'mul_unit_available', 'water_status', 'electricity_status', 'flooring', 'aminities', 'description', 'landmark', 'owner_resides',
    'land_zone', 'metro_station_name', 'prop_dist_metro', 'railway_station_name', 'prop_dist_rly', 'bus_stand_name', 'prop_dist_bus', 'airport_name',
    'prop_dist_airport', 'shopping_mall_name', 'prop_dist_mall', 'office_name', 'prop_dist_office', 'ideal_business', 'will_to_modify_interior', 'lock_in_period',
    'personal_washroom', 'pantry', 'currently_rent_out', 'office_on_floor', 'building_class', 'leed_certification', 'corner_showroom', 'main_road_facing',
    'entrance_width', 'entrance_width_unit', 'width_facing_road', 'width_facing_road_unit'];
}
