<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

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
            'password'  => 'required|min:6|max:20'
            // 'photo'     => 'required|image'
        ]);

        // $photo = $request->file('photo');
        // if ($photo->isValid()) {
        //     $file_name = rand(11111 , 999999) . date('ymdhis') . $photo->getClientOriginalExtension();
        //     $photo->storeAs('users',$file_name);
        // }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            session()->flash('type', 'success');
            session()->flash('message', 'User Registration Success!');
        } catch (Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', 'User Registration Faild!');
        }
        
        return redirect()->back();
    }

    public function userLoginform()
    {
        return view('frontend.user-login');
    }

    public function userLogin(Request $request)
    {
        $data = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:6|max:20'
        ]);
        
        if (auth()->attempt($data)) {
            return redirect('/');
        }else{
            session()->flash('type', 'danger');
            session()->flash('message', 'User Login Faild!');
            return redirect()->back();
        }
    }

    public function userLogout()
    {
        auth()->logout();
        return redirect('/');
    }
}
