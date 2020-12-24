<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
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
            'category_icon' => 'required|dimensions:max_width=32|image|mimes:png',
            'category_name' => 'required',
            'status' => 'required',
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $image = $request->file('category_icon');
        // dd($request->file('photo'));
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('categoryIcon'), $image_name);
        }
        $category->category_icon =$image_name;
        $category->save();
        return redirect('/admin/category')->with('success', 'Category Added Successfully!');
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
        $category = Category::findorfail($id);
        return view('admin.category.edit', compact('category'));
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
        $category = Category::findorfail($id);
        
        $image_name = $request->hidden_image;
        $image = $request->file('category_icon');
        if($image != '')
        {
            $request->validate([
                'category_name' => 'required',
                'status' => 'required',
                'category_icon' => 'required|dimensions:max_width=32|image|mimes:png',
            ]);   
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image->move(public_path('categoryIcon'), $image_name);
        }
        else{
            $request->validate([
                'category_name' => 'required',
                'status' => 'required',
            ]);   
        }
        $category->update(['category_name' => $request->category_name, 'status' => $request->status, 'category_icon' => $image_name]);
        return redirect('/admin/category')->with('success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id);
        if($category->category_icon){
            unlink(public_path('categoryIcon/'.$category->category_icon));
        }
        $category->delete();
        return redirect('/admin/category')->with('success', 'Category Deleted Successfully!');
    }
}
