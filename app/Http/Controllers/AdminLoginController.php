<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect(route('admin.dashboard'));
        }
        return view('admin.login');
    }

    public function auth(Request $request){
        $user =  Admin::where('username',$request->username)->first();
        if($user && Hash::check($request->password, $user->password)){
            $request->session()->put('ADMIN_LOGIN',true);
            $request->session()->put('ADMIN_ID',$user->id);
            return redirect()->intended('admin/dashboard');
        }
        else{
            $request->session()->flash('error','Invalid Login Credential');
            return redirect(route('admin.login'));
        }

    }

    public function dashboard(){
        return view('admin.pages.dashboard');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect(route('admin.login'));
    }
}
