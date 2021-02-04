<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ModelName;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use Redirect;

class ModelController extends Controller
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
        $model = new ModelName();
        $model->category_id = $request->category_id;
        $model->sub_category_id = $request->sub_category_id;
        $model->brand_id = $request->brand_name;
        $model->model_name = $request->model_name;
        $model->status = $request->status;
        $model->save();
        return response()->json(['success' => 'Model Added Successfully']);
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
        return response()->json(['success' => 'Model Deleted Successfully']);
    }

    public function getModel(Request $request)
    {
        $model = ModelName::where('id', $request->bid)->first();
        if (!empty($model)) 
        {
            $data = array('id' =>$model->id,'brand_name' =>$model->brand_id,'status' =>$model->status, 'model_name' => $model->model_name
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateModel(Request $request)
    {
        $model = ModelName::where('id', $request->id)->first();
        $input_data = array (
            'brand_id' => $request->brand_name,
            'model_name' => $request->model_name,
            'status' => $request->status,
        );

        ModelName::whereId($model->id)->update($input_data);
        return response()->json(['success' => 'Model Updated Successfully']);
    }

    public function subCategoryModel($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        // dd($subCategory);
        $brands = Brand::where('category_id', $category->id)->where('sub_category_id', $id)->where('status', 1)->get();
        $models = ModelName::where('category_id', $category->id)->where('sub_category_id', $id)->orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($models)
            ->addColumn('brand_id', function(ModelName $modelName){
                if(!empty($modelName->brands->brand_name)){
                return $modelName->brands->brand_name;
            }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.model.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.model.index', compact('subCategory', 'category', 'brands'));
    }
}
