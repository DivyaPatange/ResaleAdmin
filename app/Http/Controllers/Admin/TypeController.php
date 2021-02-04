<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Type;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class TypeController extends Controller
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
        $type = new Type();
        $type->category_id = $request->category_id;
        $type->sub_category_id = $request->sub_category_id;
        $type->type_name = $request->type_name;
        $type->status = $request->status;
        $type->save();
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
        return response()->json(['success' => 'Record Deleted Successfully']);
    }

    public function subCategoryType($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        $type = Type::where('category_id', $category->id)->where('sub_category_id', $id)->orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($type)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.type.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.type.index', compact('subCategory', 'category'));
    }

    public function getType(Request $request)
    {
        $type = Type::where('id', $request->bid)->first();
        if (!empty($type)) 
        {
            $data = array('id' =>$type->id,'type_name' =>$type->type_name,'status' =>$type->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateType(Request $request)
    {
        $type = Type::where('id', $request->id)->first();
        $input_data = array (
            'type_name' => $request->type_name,
            'status' => $request->status,
        );

        Type::whereId($type->id)->update($input_data);
        return response()->json(['success' => 'Data Updated Successfully']);
    }
}
