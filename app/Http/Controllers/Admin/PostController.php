<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::with('category')->get();
        return view('admin.post.manage', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 'active')->get();
        return view('admin.post.addPost', compact('category'));
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
            'category'   => 'required|string',
            'title'   => 'required|string|unique:posts',
            'desc' => 'required|string',
            'image' => 'required|image',
        ]);

        try {

            $photo = $request->file('image');
            if ($photo->isValid()) {
                $file_name = rand(11111 , 999999) . date('ymdhis') . $photo->getClientOriginalExtension();
                $photo->storeAs('posts',$file_name);
            }

            $posts = new Post();
            $posts->user_id = auth()->id();
            $posts->category_id = $request->category;
            $posts->title = $request->title;
            $posts->slug = strtolower(str_replace(' ', '_', $request->title));
            $posts->desc = $request->desc;
            $posts->image = $file_name;
            $posts->save();

            session()->flash('type', 'success');
            session()->flash('message', 'Post Add Successfully!');

        } catch (Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
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
    public function edit($id)
    {
        $category = Category::where('status', 'active')->get();
        $post = Post::find($id);
        if ($post) {
            return view('admin.post.editPost', compact('post','category'));
        }else{
            return redirect()->back();
        }
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
        $request->validate([
            'category'   => 'required|string',
            'title'   => 'required|string|unique:posts,id,' .$id,
            'desc' => 'required|string',
        ]);

        $posts = Post::find($id);

        try {

            if ($request->file('image')) {
                $photo = $request->file('image');
                if ($photo->isValid()) {
                    $file_name = rand(11111 , 999999) . date('ymdhis') . $photo->getClientOriginalExtension();
                    $photo->storeAs('posts',$file_name);

                    if (file_exists(public_path('uploads/posts/' . $posts->image))) unlink(public_path('uploads/posts/' . $posts->image));
                }
            }else{
                $file_name = $posts->image;
            }
            

            
            $posts->user_id = auth()->id();
            $posts->category_id = $request->category;
            $posts->title = $request->title;
            $posts->slug = strtolower(str_replace(' ', '_', $request->title));
            $posts->desc = $request->desc;
            $posts->image = $file_name;
            $posts->update();

            session()->flash('type', 'success');
            session()->flash('message', 'Post Updated Successfully!');

        } catch (Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::find($id);
        if (file_exists(public_path('uploads/posts/' . $posts->image))) {
            unlink(public_path('uploads/posts/' . $posts->image));
        }

        $posts->delete();

        session()->flash('type', 'success');
        session()->flash('message', 'Post Delete Successfully!');

        return redirect()->back();
    }
}
