<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Locality;
use App\Models\Admin\State;
use App\Models\Admin\City;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localities = Locality::all();
        $states = State::where('status', 1)->get();
        return view('admin.locality.index', compact('localities', 'states'));
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

    public function getCityList(Request $request)
    {
        $city = City::where("state_id", $request->state_id)->where('status', 1)
        ->pluck("city_name","id");
        return response()->json($city);
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
            'locality' => 'required',
        ]);
        $locality = new Locality();
        $locality->state_id = $request->state_name;
        $locality->city_id = $request->city_name;
        $locality->locality = $request->locality;
        $locality->save();
        return redirect('/admin/locality')->with('success', 'Locality Added Successfully');

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
        $locality = Locality::findorfail($id);
        $states = State::where('status', 1)->get();
        $cities = City::where('state_id', $locality->state_id)->where('status', 1)->get();
        // dd($cities);
        return view('admin.locality.edit', compact('locality', 'states', 'cities'));
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
        $locality = Locality::findorfail($id);
        $request->validate([
            'state_name' => 'required',
            'city_name' => 'required',
            'locality' => 'required',
        ]);
        $locality->state_id = $request->state_name;
        $locality->city_id = $request->city_name;
        $locality->locality = $request->locality;
        $locality->update($request->all());
        return redirect('/admin/locality')->with('success', 'Locality Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locality = Locality::findorfail($id);
        $locality->delete();
        return redirect('/admin/locality')->with('success', 'Locality Deleted Successfully');
    }
}
