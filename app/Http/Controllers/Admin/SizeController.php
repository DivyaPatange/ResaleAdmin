<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Size;
use App\Models\Admin\Type;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;

class SizeController extends Controller
{
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
        $size = new Size();
        $size->type_id = $request->type_name;
        $size->size = $request->size;
        $size->category_id = $request->category_id;
        $size->sub_category_id = $request->sub_category_id;
        $size->status = $request->status;
        $size->save();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findorfail($id);
        $size->delete();
        return response()->json(['success' => 'Record Deleted Successfully']);
    }

    public function subCategorySize($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        $type = Type::where('category_id', $category->id)->where('sub_category_id', $id)->where('status', 1)->get();
        $size = Size::where('category_id', $category->id)->where('sub_category_id', $id)->orderBy('id', 'DESC')->get();
        // dd($type);
        if(request()->ajax()) {
            return datatables()->of($size)
            ->addColumn('type_id', function(Size $size1){
                if(!empty($size1->types->type_name)){
                return $size1->types->type_name;
            }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.size.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.size.index', compact('subCategory', 'category', 'type'));
    }

    public function getSize(Request $request)
    {
        $size = Size::where('id', $request->bid)->first();
        if (!empty($size)) 
        {
            $data = array('id' =>$size->id,'size' =>$size->size,'status' =>$size->status, 'type_name' => $size->type_id
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateSize(Request $request)
    {
        $size = Size::where('id', $request->id)->first();
        $input_data = array (
            'type_id' => $request->type_name,
            'size' => $request->size,
            'status' => $request->status,
        );

        Size::whereId($size->id)->update($input_data);
        return response()->json(['success' => 'Record Updated Successfully']);
    }
}
