<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Suggestion;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $suggestions = Suggestion::all();
        return view('admin.suggestion.index', compact('categories', 'suggestions'));
    }

    public function getSubCategoryList(Request $request)
    {
        $subCategory = SubCategory::where("category_id", $request->category_id)->where('status', 1)
            ->pluck("sub_category","id");
            return response()->json($subCategory);
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
            'suggestion' => 'required',
        ]);
        $suggestion = new Suggestion();
        $suggestion->category_id = $request->category_name;
        $suggestion->sub_category_id = $request->sub_category;
        $suggestion->suggestion = $request->suggestion;
        $suggestion->save();
        return redirect('/admin/suggestion')->with('success', 'Suggestion Added Successfully!');
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
        $suggestion = Suggestion::findorfail($id);
        $categories = Category::where('status', 1)->get();
        return view('admin.suggestion.edit', compact('suggestion', 'categories'));
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
        $suggestion = Suggestion::findorfail($id);
        $request->validate([
            'category_name' => 'required',
            'sub_category' => 'required',
            'suggestion' => 'required',
        ]);
        $suggestion->category_id = $request->category_name;
        $suggestion->sub_category_id = $request->sub_category;
        $suggestion->suggestion = $request->suggestion;
        $suggestion->update($request->all());
        return redirect('/admin/suggestion')->with('success', 'Suggestion Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suggestion = Suggestion::findorfail($id);
        $suggestion->delete();
        return redirect('/admin/suggestion')->with('success', 'Suggestion Deleted Successfully!');
    }
}
