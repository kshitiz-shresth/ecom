<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function change(Request $request){

        $model = $request->model;
        $order = 1;
        foreach($request->arr as $item){
            $data = '\\App\\Models\\'.$model;
            $data = $data::find($item);
            $data->order = $order;
            $data->update();
            $order++;
        }
        return response([
            'type'=>'success',
            'message'=>'Order Updated Successfully'
        ]);
    }
}
