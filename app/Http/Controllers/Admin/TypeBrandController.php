<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TypeBrand;
use App\Models\Admin\Type;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class TypeBrandController extends Controller
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
        $types = Type::where('status', 1)->get();
        $typeBrand = TypeBrand::all();
        return view('admin.typeBrand.index', compact('typeBrand', 'types'));
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
        $typeBrand = new TypeBrand();
        $typeBrand->type_id = $request->type_name;
        $typeBrand->type_brand_name = $request->brand_name;
        $typeBrand->category_id = $request->category_id;
        $typeBrand->sub_category_id = $request->sub_category_id;
        $typeBrand->status = $request->status;
        $typeBrand->save();
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
        $types = Type::where('status', 1)->get();
        $typeBrand = TypeBrand::findorfail($id);
        return view('admin.typeBrand.edit', compact('typeBrand', 'types'));
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
        $request->validate([
            'brand_name' => 'required',
            'type_name' => 'required',
            'status' => 'required',
        ]);
        $typeBrand = TypeBrand::findorfail($id);
        $typeBrand->type_id = $request->type_name;
        $typeBrand->type_brand_name = $request->brand_name;
        $typeBrand->status = $request->status;
        $typeBrand->update($request->all());
        return redirect('/admin/type-brand')->with('success', 'Brand Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typeBrand = TypeBrand::findorfail($id);
        $typeBrand->delete();
        return response()->json(['success' => 'Record Deleted Successfully']);
    }

    public function subCategoryTypeBrand($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        $type = Type::where('category_id', $category->id)->where('sub_category_id', $id)->where('status', 1)->get();
        $typeBrand = TypeBrand::where('category_id', $category->id)->where('sub_category_id', $id)->orderBy('id', 'DESC')->get();
        // dd($type);
        if(request()->ajax()) {
            return datatables()->of($typeBrand)
            ->addColumn('type_id', function(TypeBrand $typeBrand){
                if(!empty($typeBrand->types->type_name)){
                return $typeBrand->types->type_name;
            }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.typeBrand.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.typeBrand.index', compact('subCategory', 'category', 'type'));
    }

    public function getTypeBrand(Request $request)
    {
        $typeBrand = TypeBrand::where('id', $request->bid)->first();
        if (!empty($typeBrand)) 
        {
            $data = array('id' =>$typeBrand->id,'brand_name' =>$typeBrand->type_brand_name,'status' =>$typeBrand->status, 'type_name' => $typeBrand->type_id
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateTypeBrand(Request $request)
    {
        $typeBrand = TypeBrand::where('id', $request->id)->first();
        $input_data = array (
            'type_id' => $request->type_name,
            'type_brand_name' => $request->brand_name,
            'status' => $request->status,
        );

        TypeBrand::whereId($typeBrand->id)->update($input_data);
        return response()->json(['success' => 'Record Updated Successfully']);
    }
}

