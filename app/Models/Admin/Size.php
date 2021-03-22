<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = "sizes";

    protected $fillable = ['type_id', 'size', 'status'];

    public function types(){
        return $this->belongsTo('App\Models\Admin\Type','type_id', 'id');
    }
}
