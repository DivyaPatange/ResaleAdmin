<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\CategoryField;

class CategoryFormFieldController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.createForm.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'sub_category' => 'required',
        ]);
        $field = new CategoryField();
        $field->category_id = $request->category_name;
        $field->sub_category_id = $request->sub_category;
        $field->save();
        return redirect('/admin/form-field');
    }

    public function addFieldForm($id)
    {
        return view('admin.createForm.addField');
    }
}
