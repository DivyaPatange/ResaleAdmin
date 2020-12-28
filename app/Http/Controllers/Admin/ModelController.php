<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ModelName;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $model = ModelName::all();
        return view('admin.model.index', compact('model', 'brands', 'categories'));
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

    public function getBrandList(Request $request)
    {
        $brand = Brand::where("sub_category_id", $request->brand_id)->where('status', 1)
            ->pluck("brand_name","id");
            return response()->json($brand);
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
            'brand_name' => 'required',
            'model_name' => 'required',
            'status' => 'required',
        ]);
        $model = new ModelName();
        $model->category_id = $request->category_name;
        $model->sub_category_id = $request->sub_category;
        $model->brand_id = $request->brand_name;
        $model->model_name = $request->model_name;
        $model->status = $request->status;
        $model->save();
        return redirect('/admin/model-name')->with('success', 'Model Name Added Successfully!');
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
        $brands = Brand::where('status', 1)->get();
        $model = ModelName::findorfail($id);
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('category_id', $model->category_id)->where('status', 1)->get();
        return view('admin.model.edit', compact('model', 'brands', 'categories', 'subCategories'));
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
        $model = ModelName::findorfail($id);
        $request->validate([
            'category_name' => 'required',
            'sub_category' => 'required',
            'brand_name' => 'required',
            'model_name' => 'required',
            'status' => 'required',
        ]);
        $model->category_id = $request->category_name;
        $model->sub_category_id = $request->sub_category;
        $model->brand_id = $request->brand_name;
        $model->model_name = $request->model_name;
        $model->status = $request->status;
        $model->update($request->all());
        return redirect('/admin/model-name')->with('success', 'Model Name Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ModelName::findorfail($id);
        $model->delete();
        return redirect('/admin/model-name')->with('success', 'Model Name Deleted Successfully!');
    }
}
