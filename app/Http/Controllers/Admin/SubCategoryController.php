<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Brand;
use App\Models\Admin\ModelName;

class SubCategoryController extends Controller
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
        $categories = Category::where('status', 1)->get();
        $subCategory = SubCategory::all();
        return view('admin.subCategory.index', compact('categories', 'subCategory'));
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
            'status' => 'required',
        ]);
        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_name;
        $subCategory->sub_category =  $request->sub_category;
        $subCategory->status  = $request->status;
        $subCategory->save();
        return redirect('/admin/sub-category')->with('success', 'Sub-Category Added Successfully!');
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
        $subCategory = SubCategory::findorfail($id);
        $categories = Category::all();
        return view('admin.subCategory.edit', compact('subCategory', 'categories'));
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
        $subCategory = SubCategory::findorfail($id);
        $request->validate([
            'category_name' => 'required',
            'sub_category' => 'required',
            'status' => 'required',
        ]);
        $subCategory->category_id = $request->category_name;
        $subCategory->sub_category = $request->sub_category;
        $subCategory->status = $request->status;
        $subCategory->update($request->all());
        return redirect('/admin/sub-category')->with('success', 'Sub-Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $subCategory->delete();
        return redirect('/admin/sub-category')->with('success', 'Sub-Category Deleted Successfully!');
    }

    public function getSubCategoryView($cid, $sid, Request $request)
    {
        $category = Category::findorfail($cid);
        $subCategory = SubCategory::findorfail($sid);
        $brands = Brand::where('category_id', $cid)->where('sub_category_id', $sid)->where('status', 1)->get();
        $models = ModelName::where('category_id', $cid)->where('sub_category_id', $sid)->where('status', 1)->get();
        // dd($subCategory);
        if(request()->ajax()) {
            if($request->brand == "brand"){
            return datatables()->of(Brand::select('*'))
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.brand.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        }
        // if(request()->ajax()) {
        //     return datatables()->of(ModelName::select('*'))
        //     ->addColumn('brand_name', function($row){
        //         return $row->model_name->course_name;
        //     })
        //     ->addColumn('status', function($row){
        //         if($row->status == 1)
        //         return 'Active';
        //         else
        //         return 'Inactive';
        //     })
        //     ->addColumn('action', '')
        //     ->rawColumns(['action'])
        //     ->addIndexColumn()
        //     ->make(true);
        // }
        return view('admin.getSubCategoryView.index', compact('category', 'subCategory'));
    }
}
