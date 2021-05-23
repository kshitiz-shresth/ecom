<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['category'] = Category::find($request->cat_id);
        $data['sub_categories'] = $data['category']  ? $data['category'] ->sub_categories : [];
        return view('admin.pages.sub-category.browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['category'] = Category::find($request->cat_id);
        return view('admin.pages.sub-category.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'slug'=>'unique:sub_categories,slug,NULL,id,category_id,'.$request->category_id,
            ]
            );
        SubCategory::create($request->all());
        if($request->submit){
            $request->session()->flash('success','Successfully Created');
            return redirect(route('sub-category.index','cat_id='.$request->category_id));
        }
        $request->session()->flash('success','Successfully Created');
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
    public function edit($id,Request $request)
    {
        $data['category'] = Category::find($request->cat_id);
        $data['sub_category'] = SubCategory::find($id);
        return view('admin.pages.sub-category.edit',$data);
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
            $request->validate(
               [
                   'slug'=>'unique:sub_categories,slug,'.$id.',id,category_id,'.$request->category_id,
               ]
               );
            SubCategory::find($id)->update($request->all());
            $request->session()->flash('success','Successfully Updated');
            return redirect(route('sub-category.index','cat_id='.$request->category_id));
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
