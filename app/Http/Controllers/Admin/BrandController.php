<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use Redirect;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands', 'categories'));
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
            'status' => 'required',
            'category_name' => 'required',
        ]);
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->status = $request->status;
        $brand->category_id = $request->category_name;
        $brand->sub_category_id = $request->sub_category;
        $brand->save();
        return Redirect::back()->with('success', 'Brand Added Successfully!');
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
        $brand = Brand::findorfail($id);
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('category_id', $brand->category_id)->where('status', 1)->get();
        return view('admin.brand.edit', compact('brand', 'categories', 'subCategories'));
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
        $brand = Brand::findorfail($id);
        $request->validate([
            'brand_name' => 'required',
            'status' => 'required',
            'category_name' => 'required',
            'sub_category' => 'required',
        ]);
        $brand->category_id = $request->category_name;
        $brand->sub_category_id = $request->sub_category;
        $brand->brand_name = $request->brand_name;
        $brand->status = $request->status;
        $brand->update($request->all());
        return redirect('/admin/brands')->with('success', 'Brand Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findorfail($id);
        $brand->delete();
        return Redirect::back()->with('success', 'Brand Deleted Successfully!');
    }

    public function getBrand(Request $request)
    {
        $brand = Brand::where('id', $request->bid)->first();
        if (!empty($brand)) 
        {
            $data = array('id' =>$brand->id,'brand_name' =>$brand->brand_name,'status' =>$brand->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
        // return $brand;
    }

}
