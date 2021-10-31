<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Exception;

class SiteController extends Controller
{
    public function index()
    {
        $posts = Post::with('user','category')->get();
        $categories = Category::with('posts')->where('status', 'active')->get();
        return view('frontend.home', compact('posts','categories'));
    }

    public function singlepost($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categories = Category::where('status', 'active')->get();
        return view('frontend.single-post', compact('post','categories'));
    }

    public function categoryPost($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::where('category_id', $category->id)->get();
        $categories = Category::where('status', 'active')->get();
        return view('frontend.categoryPost', compact('posts','categories'));
    }

    public function searchPost(Request $request)
    {
        $search = $request->search;

        $posts = Post::with('user','category')->where('title','Like', '%'.$search.'%')->get();
        $categories = Category::where('status', 'active')->get();
        return view('frontend.home', compact('posts','categories'));
    }

    public function userRegisterform()
    {
        $categories = Category::where('status', 'active')->get();
        return view('frontend.user-register', compact('categories'));
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
        $categories = Category::where('status', 'active')->get();
        return view('frontend.user-login', compact('categories'));
    }

    public function userLogin(Request $request)
    {
        $data = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:6|max:20'
        ]);
        
        if (auth()->attempt($data)) {
            return redirect('/admin/dashboard');
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
