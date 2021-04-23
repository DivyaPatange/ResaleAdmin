<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateBenefit extends Model
{
    use HasFactory;

    protected $table = "rate_benefits";

    protected $fillable = ['rate_id', 'benefits'];
}
