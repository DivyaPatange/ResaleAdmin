<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TypeBrand;
use App\Models\Admin\BrandModel;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class BrandModelController extends Controller
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
    public function subCategoryBrandModel($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        $typeBrand = TypeBrand::where('sub_category_id', $id)->where('status', 1)->get();
        $brandModel = BrandModel::orderBy('id', 'DESC')->get();
        // dd($type);
        if(request()->ajax()) {
            return datatables()->of($brandModel)
            ->addColumn('type_brand_id', function($row){
                $brandName = TypeBrand::where('id', $row->type_brand_id)->first();
                if(!empty($brandName)){
                    return $brandName->type_brand_name;
                }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.brand-model.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.brand-model.index', compact('subCategory', 'category', 'typeBrand'));
    }

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
        $brandModel = new BrandModel();
        $brandModel->type_brand_id = $request->brand_name;
        $brandModel->model_name = $request->model_name;
        $brandModel->status = $request->status;
        $brandModel->save();
        return response()->json(['success' => 'Record Added Successfully']);
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

    public function getBrandModel(Request $request)
    {
        $brandModel = BrandModel::where('id', $request->bid)->first();
        if (!empty($brandModel)) 
        {
            $data = array('id' =>$brandModel->id,'type_brand_id' =>$brandModel->type_brand_id,'status' =>$brandModel->status, 'model_name' => $brandModel->model_name
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateBrandModel(Request $request)
    {
        $brandModel = BrandModel::where('id', $request->id)->first();
        $input_data = array (
            'type_brand_id' => $request->brand_name,
            'model_name' => $request->model_name,
            'status' => $request->status,
        );

        BrandModel::whereId($brandModel->id)->update($input_data);
        return response()->json(['success' => 'Record Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brandModel = BrandModel::findorfail($id);
        $brandModel->delete();
        return response()->json(['success' => 'Record Deleted Successfully']);
    }
}
