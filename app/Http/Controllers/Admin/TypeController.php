<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Type;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $types = Type::all();
        return view('admin.type.index', compact('types', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'sub_category' => 'required',
            'type_name' => 'required',
            'status' => 'required',
        ]);
        $type = new Type();
        $type->category_id = $request->category_name;
        $type->sub_category_id = $request->sub_category;
        $type->type_name = $request->type_name;
        $type->status = $request->status;
        $type->save();
        return redirect('/admin/types')->with('success', 'Type Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('status', 1)->get();
        $type = Type::findorfail($id);
        $subCategories = SubCategory::where('category_id', $type->category_id)->where('status', 1)->get();
        return view('admin.type.edit', compact('type', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = Type::findorfail($id);
        $request->validate([
            'category_name' => 'required',
            'sub_category' => 'required',
            'type_name' => 'required',
            'status' => 'required',
        ]);
        $type->category_id = $request->category_name;
        $type->sub_category_id = $request->sub_category;
        $type->type_name = $request->type_name;
        $type->status = $request->status;
        $type->update($request->all());
        return redirect('/admin/types')->with('success', 'Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::findorfail($id);
        $type->delete();
        return redirect('/admin/types')->with('success', 'Type Deleted Successfully!');
    }
}
