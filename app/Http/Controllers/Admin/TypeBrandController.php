<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TypeBrand;
use App\Models\Admin\Type;

class TypeBrandController extends Controller
{
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
        $request->validate([
            'type_name' => 'required',
            'brand_name' => 'required',
            'status' => 'required',
        ]);
        $typeBrand = new TypeBrand();
        $typeBrand->type_id = $request->type_name;
        $typeBrand->type_brand_name = $request->brand_name;
        $typeBrand->status = $request->status;
        $typeBrand->save();
        return redirect('/admin/type-brand')->with('success', 'Brand added Successfully!');
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
        $typeBrand = TypeBrand::findorfail($id);
        return view('admin.typeBrand.edit', compact('typeBrand'));
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
        return redirect('/admin/type-brand')->with('success', 'Brand Deleted Successfully!');
    }
}
