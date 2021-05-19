<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\RateCard;
use App\Models\Admin\RateBenefit;
use App\Models\Admin\Category;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rateCard = RateCard::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($rateCard)
            ->addColumn('category_id', function($row){   
                $category = Category::where('id', $row->category_id)->first();
                if(!empty($category))
                {
                    return $category->category_name;
                }
            })
            ->addColumn('benefits', function($row){    
                $rateBenefit = RateBenefit::where('rate_id', $row->id)->get();
                $output = "";
                $output .='<ol type="1">';
                foreach($rateBenefit as $r){
                    $output .='<li>'.$r->benefits.'</li>';
                }
                $output .='</ol>'; 
                return $output;                                                                                                                                                                                                                                                                                    
            })
            ->addColumn('action', 'admin.rate-card.action')
            ->rawColumns(['action', 'benefits'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.rate-card.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.rate-card.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rateCard = new RateCard();
        $rateCard->category_id = $request->category;
        $rateCard->title = $request->title;
        $rateCard->rate_price = $request->price;
        $rateCard->discount_per = $request->discount_per;
        $rateCard->discount_rate = $request->discount_rate;
        $rateCard->quantity = $request->quantity;
        $rateCard->duration = $request->duration;
        $rateCard->save();
        $benefit = $request->benefit;
        for($i=0; $i < count($benefit); $i++)
        {
            $rateB = new RateBenefit();
            $rateB->rate_id = $rateCard->id;
            $rateB->benefits = $benefit[$i];
            $rateB->save();
        }
        return response()->json(['success' => 'Rate Card Added Successfully']);
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
        $rateCard = RateCard::findorfail($id);
        $rateB = RateBenefit::where('rate_id', $rateCard->id)->get();
        foreach($rateB as $r)
        {
            $rateBE = RateBenefit::where('id', $r->id)->first();
            $rateBE->delete();
        }
        $rateCard->delete();
        return response()->json(['success' => 'Record Deleted Successfully!']);
    }
}
