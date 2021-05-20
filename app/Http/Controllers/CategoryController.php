<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::latest()->get();
        return view('admin.pages.category.browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create($request->all());
        $request->session()->flash('success','Successfully Created');
        return redirect(route('category.index'));
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
        $data['category'] = Category::find($id);
        return view('admin.pages.category.edit',$data);
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
            Category::find($id)->update($request->all());
            $request->session()->flash('success','Successfully Updated');
            return redirect(route('category.index'));
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
        if(Category::find($id)->sub_categories->count()>0){
            return response([
                'type'=>'error',
                'title'=> 'Oops...',
                'text'=>'Cannot Proceed as this Category have other sub categories.'
            ]);
        }
        $title = Category::find($id) ? Category::find($id)->name : '';
        if(Category::find($id)->delete()){
            return response([
                'type' => 'success',
                'title'=> 'Success!!',
                'text' => $title ? $title.' category has been deleted successfully.' :'Successfully Deleted'
            ]);
        }
        return response([
            'type' => 'error',
            'title'=> 'Error!!',
            'text' => 'Failed'
        ]);

    }
}
