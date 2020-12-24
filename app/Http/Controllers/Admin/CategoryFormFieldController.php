<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryFormFieldController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.createForm.index', compact('categories'));
    }
}
