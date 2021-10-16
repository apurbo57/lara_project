<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $category = Category::all();
        return view('admin.category.manage', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.addCategory');
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
            'name'   => 'required|string|unique:categories',
            'status' => 'required|string',
        ]);

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->user_id = auth()->id();
            $category->slug = strtolower(str_replace(' ', '_', $request->name));
            $category->status = $request->status;
            $category->save();

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
        $category = Category::find($id);
        if ($category) {
            return view('admin.category.editCategory', compact('category'));
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
            'name'   => 'required|string|unique:categories,id,'.$id,
            'status' => 'required|string',
        ]);

        try {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->user_id = auth()->id();
            $category->slug = strtolower(str_replace(' ', '_', $request->name));
            $category->status = $request->status;
            $category->update();

            session()->flash('type', 'success');
            session()->flash('message', 'Category Update Successfully!');

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
        $category = Category::find($id);
        $category->delete();

        session()->flash('type', 'success');
        session()->flash('message', 'Category Delete Successfully!');

        return redirect()->back();
    }
}
