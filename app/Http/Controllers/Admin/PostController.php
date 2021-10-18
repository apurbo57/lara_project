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
        $post = Post::all();
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
            'title'   => 'required|string|unique:categories',
            'desc' => 'required|string',
            'image' => 'required|image',
        ]);

        dd($request);

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
            $posts->status = $request->status;
            $posts->save();

            session()->flash('type', 'success');
            session()->flash('message', 'Category Add Successfully!');

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
        //
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
        //
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
