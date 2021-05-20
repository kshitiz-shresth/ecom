<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Exception;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['sub_category'] = SubCategory::find($request->sub_cat_id);
        $data['sub_sub_categories'] = $data['sub_category']  ? $data['sub_category'] ->sub_sub_categories : [];
        return view('admin.pages.sub-sub-category.browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['sub_category'] = SubCategory::find($request->sub_cat_id);
        return view('admin.pages.sub-sub-category.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SubSubCategory::create($request->all());
        if($request->submit){
            return redirect(route('sub-category.index','sub_cat_id='.$request->sub_category_id));
        }
        return redirect()->back();
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
    public function edit($id, Request $request)
    {
        $data['sub_category'] = SubCategory::find($request->sub_cat_id);
        $data['sub_sub_category'] = SubSubCategory::find($id);
        return view('admin.pages.sub-sub-category.edit',$data);
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
        try{
            SubSubCategory::find($id)->update($request->all());
            $request->session()->flash('success','Successfully Updated');
            return redirect(route('sub-sub-category.index','sub_cat_id='.$request->sub_category_id));
        }
        catch(Exception $e){
            $request->session()->flash('error',$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
