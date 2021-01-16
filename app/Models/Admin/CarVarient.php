<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVarient extends Model
{
    use HasFactory;

    protected $table = "car_varients";

    protected $fillable = ['category_id', 'sub_category_id', 'car_varient'];
}
