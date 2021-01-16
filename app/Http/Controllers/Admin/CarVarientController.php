<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\CarVarient;

class CarVarientController extends Controller
{
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
        $request->validate([
            'category_name' => 'required',
            'sub_category' => 'required',
            'car_varient' => 'required',
        ]);
        $carVarient = new CarVarient();
        $carVarient->category_id = $request->category_name;
        $carVarient->sub_category_id = $request->sub_category;
        $carVarient->car_varient = $request->car_varient;
        $carVarient->save();
        return redirect('/admin/car-varient')->with('success', 'Car Varient Added Successfully!');
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
        return view('admin.carVarient.edit', compact('carVarient', 'categories', 'subCategories'));
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
        ]);
        $carVarient->category_id = $request->category_name;
        $carVarient->sub_category_id = $request->sub_category;
        $carVarient->car_varient = $request->car_varient;
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
        return redirect('/admin/car-varient')->with('success', 'Car Varient Deleted Successfully!');
    }
}
