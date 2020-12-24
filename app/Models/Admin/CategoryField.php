<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryField extends Model
{
    use HasFactory;

    protected $table = "category_fields_table";

    protected $fillable = ['category_id', 'sub_category_id'];
}
