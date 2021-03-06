<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\CarVarient;
use App\Models\Admin\Brand;
use App\Models\Admin\ModelName;

class CarVarientController extends Controller
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
        $carVarient = CarVarient::all();
        return view('admin.carVarient.index', compact('categories', 'carVarient'));
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
        $carVarient = new CarVarient();
        $carVarient->category_id = $request->category_id;
        $carVarient->sub_category_id = $request->sub_category_id;
        $carVarient->brand_id = $request->brand_name;
        $carVarient->model_id = $request->model_name;
        $carVarient->car_varient = $request->car_varient;
        $carVarient->save();
        return response()->json(['success' => 'Car Varient Added Successfully']);
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
        $carVarient = CarVarient::findorfail($id);
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('category_id', $carVarient->category_id)->where('status', 1)->get();
        $brand = Brand::where('sub_category_id', $carVarient->sub_category_id)->where('status', 1)->get();
        $model = ModelName::where('brand_id', $carVarient->brand_id)->where('status', 1)->get();
        return view('admin.carVarient.edit', compact('carVarient', 'categories', 'subCategories', 'brand', 'model'));
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
        $carVarient = CarVarient::findorfail($id);
        $request->validate([
            'category_name' => 'required',
            'sub_category' => 'required',
            'car_varient' => 'required',
            'model_name' => 'required',
            'brand_name' => 'required',
        ]);
        $carVarient->category_id = $request->category_name;
        $carVarient->sub_category_id = $request->sub_category;
        $carVarient->car_varient = $request->car_varient;
        $carVarient->brand_id = $request->brand_name;
        $carVarient->model_id = $request->model_name;
        $carVarient->update($request->all());
        return redirect('/admin/car-varient')->with('success', 'Car Varient Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carVarient = CarVarient::findorfail($id);
        $carVarient->delete();
        return response()->json(['success' => 'Car Varient Deleted Successfully']);
    }

    public function getSubBrandList(Request $request)
    {
        $brand = Brand::where("sub_category_id", $request->sub_category_id)->where('status', 1)
        ->pluck("brand_name","id");
        return response()->json($brand);
    }

    public function getSubModelList(Request $request)
    {
        $model = ModelName::where("brand_id", $request->brand_id)->where('status', 1)
        ->pluck("model_name","id");
        return response()->json($model);
    }

    public function subCategoryCarVarient($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        $brands = Brand::where('category_id', $category->id)->where('sub_category_id', $id)->where('status', 1)->get();
        $models = ModelName::where('category_id', $category->id)->where('sub_category_id', $id)->where('status', 1)->get();
        $carVarient = CarVarient::where('category_id', $category->id)->where('sub_category_id', $id)->orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($carVarient)
            ->addColumn('brand_id', function(CarVarient $carVarient){
                if(!empty($carVarient->brands->brand_name)){
                return $carVarient->brands->brand_name;
                }
            })
            ->addColumn('model_id', function(CarVarient $carVarient){
                if(!empty($carVarient->model_name->model_name)){
                    return $carVarient->model_name->model_name;
                    }
            })
            ->addColumn('action', 'admin.carVarient.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.carVarient.index', compact('subCategory', 'category', 'brands', 'models'));
    }

    public function getCarVarient(Request $request)
    {
        $carVarient = CarVarient::where('id', $request->bid)->first();
        if (!empty($carVarient)) 
        {
            $data = array('id' =>$carVarient->id,'brand_id' =>$carVarient->brand_id,'model_id' =>$carVarient->model_id, 'car_varient' => $carVarient->car_varient
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateCarVarient(Request $request)
    {
        $carVarient = CarVarient::where('id', $request->id)->first();
        $input_data = array (
            'brand_id' => $request->brand_name,
            'model_id' => $request->model_name,
            'car_varient' => $request->car_varient,
        );

        CarVarient::whereId($carVarient->id)->update($input_data);
        return response()->json(['success' => 'Car Varient Updated Successfully']);
    }
}
