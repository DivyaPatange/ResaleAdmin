<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = "jobs";

    protected $fillable = ['user_id', 'sub_category_id', 'job_title', 'job_type', 'salary_period', 
    'position', 'min_monthly_salary', 'max_monthly_salary', 'min_experience', 'max_experience', 'company_name',
    'job_description', 'photos', 'state_id', 'city_id', 'locality_id', 'pin_code', 'address', 'name',
    'email', 'mobile_no'];
}
