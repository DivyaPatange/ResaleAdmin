<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\City;
use App\Models\Admin\State;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::where('status', 1)->get();
        $cities = City::all();
        return view('admin.city.index', compact('states', 'cities'));
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
            'state_name' => 'required',
            'city_name' => 'required',
            'status' => 'required',
        ]);
        $city = new City();
        $city->state_id = $request->state_name;
        $city->city_name = $request->city_name;
        $city->status = $request->status;
        $city->save();
        return redirect('/admin/city')->with('success', 'City Added Successfully!');
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
        $city = City::findorfail($id);
        $states = State::where('status', 1)->get();
        return view('admin.city.edit', compact('states', 'city'));
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
        $city = City::findorfail($id);
        $request->validate([
            'state_name' => 'required',
            'city_name' => 'required',
            'status' => 'required',
        ]);
        $city->state_id = $request->state_name;
        $city->city_name = $request->city_name;
        $city->status = $request->status;
        $city->update($request->all());
        return redirect('/admin/city')->with('success', 'City Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findorfail($id);
        $city->delete();
        return redirect('/admin/city')->with('success', 'City Deleted Successfully!');
    }
}
