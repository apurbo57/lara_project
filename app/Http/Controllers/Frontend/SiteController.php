<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function singlepost()
    {
        return view('frontend.single-post');
    }

    public function userRegisterform()
    {
        return view('frontend.user-register');
    }

    public function userRegistration(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required|min:6|max:20',
            'photo'     => 'required|image'
        ]);

        $photo = $request->file('photo');
        if ($photo->isValid()) {
            $file_name = rand(11111 , 999999) . date('ymdhis') . $photo->getClientOriginalExtension();
            $photo->storeAs('users',$file_name);
        }
        
        session()->flash('message', 'User Registration Success!');
        return redirect()->back();
    }
}
