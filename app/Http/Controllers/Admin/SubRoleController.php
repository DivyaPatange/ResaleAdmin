<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SubRole;
use App\Models\Admin\Role;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class SubRoleController extends Controller
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
        $subRole = new SubRole();
        $subRole->role_id = $request->role_name;
        $subRole->sub_role = $request->sub_role;
        $subRole->status = $request->status;
        $subRole->save();
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
        $subRole = SubRole::findorfail($id);
        $subRole->delete();
        return response()->json(['success' => 'Record Deleted Successfully']);
    }

    public function subCategorySubrole($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        $role = Role::where('status', 1)->get();
        $subRole = SubRole::orderBy('id', 'DESC')->get();
        // dd($type);
        if(request()->ajax()) {
            return datatables()->of($subRole)
            ->addColumn('role_id', function(SubRole $subRole){
                if(!empty($subRole->roles->role_name)){
                return $subRole->roles->role_name;
            }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.subRole.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.subRole.index', compact('subCategory', 'category', 'role'));
    }

    public function getSubrole(Request $request)
    {
        $subRole = SubRole::where('id', $request->bid)->first();
        if (!empty($subRole)) 
        {
            $data = array('id' =>$subRole->id,'sub_role' =>$subRole->sub_role,'status' =>$subRole->status, 'role_name' => $subRole->role_id
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateSubrole(Request $request)
    {
        $subRole = SubRole::where('id', $request->id)->first();
        $input_data = array (
            'role_id' => $request->role_name,
            'sub_role' => $request->sub_role,
            'status' => $request->status,
        );

        SubRole::whereId($subRole->id)->update($input_data);
        return response()->json(['success' => 'Record Updated Successfully']);
    }
}
