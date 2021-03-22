<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Role;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('admin.role.index', compact('roles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->role_name = $request->role_name;
        $role->status = $request->status;
        $role->save();
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
        $role = Role::findorfail($id);
        $role->delete();
        return response()->json(['success' => 'Role Deleted Successfully']);
    }

    public function subCategoryRole($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        $role = Role::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($role)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.role.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.role.index', compact('subCategory', 'category'));
    }

    public function getRole(Request $request)
    {
        $role = Role::where('id', $request->bid)->first();
        if (!empty($role)) 
        {
            $data = array('id' =>$role->id,'role_name' =>$role->role_name,'status' =>$role->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateRole(Request $request)
    {
        $role = Role::where('id', $request->id)->first();
        $input_data = array (
            'role_name' => $request->role_name,
            'status' => $request->status,
        );

        Role::whereId($role->id)->update($input_data);
        return response()->json(['success' => 'Data Updated Successfully']);
    }
}
