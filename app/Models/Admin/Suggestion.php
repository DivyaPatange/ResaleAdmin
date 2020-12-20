<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $table = "suggestions";

    protected $fillable = ['category_id', 'sub_category_id', 'suggestion'];
}
