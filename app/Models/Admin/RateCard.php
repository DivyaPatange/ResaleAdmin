<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateCard extends Model
{
    use HasFactory;

    protected $table = "rate_cards";

    protected $fillable = ['category_id', 'title', 'rate_price', 'discount_per', 'discount_rate', 'quantity', 'duration'];
}
