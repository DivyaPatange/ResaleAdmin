<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use App\Models\Admin\TypeBrand;
use App\Models\Admin\BrandModel;
use App\Models\Admin\CarVarient;

class CommercialCarVarientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function commercialCarVarient($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        $brands = TypeBrand::where('category_id', $category->id)->where('sub_category_id', $id)->where('status', 1)->get();
        $models = BrandModel::where('status', 1)->get();
        $carVarient = CarVarient::where('category_id', $category->id)->where('sub_category_id', $id)->orderBy('id', 'DESC')->get();
        // dd($carVarient);
        if(request()->ajax()) {
            return datatables()->of($carVarient)
            ->addColumn('brand_id', function($row){
                $brandName = TypeBrand::where('id', $row->brand_id)->first();
                if(!empty($brandName))
                {
                    return $brandName->type_brand_name;
                }
            })
            ->addColumn('model_id', function($row){
                $modelName = BrandModel::where('id', $row->model_id)->first();
                if(!empty($modelName)){
                    return $modelName->model_name;
                }
            })
            ->addColumn('action', 'admin.commercialCarVarient.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.commercialCarVarient.index', compact('subCategory', 'category', 'brands', 'models'));
    }

    public function getBrandModelList(Request $request)
    {
        $model = BrandModel::where("type_brand_id", $request->brand_id)->where('status', 1)
        ->pluck("model_name","id");
        return response()->json($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
