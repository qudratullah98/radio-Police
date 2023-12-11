<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index')->with('categories', Category::paginate(10));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'en_name' => 'required|max:15',
            'da_name' => 'required|max:15',
            'pa_name' => 'required|max:15',
            // 'main_menu' => 'required|boolean',
            // 'status' => 'required|boolean',
        ]);

        Category::create([ 'created_by'=>Auth::user()->id, 'en_name'=> $request->en_name, 'da_name'=>$request->da_name, 'pa_name'=>$request->pa_name, 'main_menu'=>$request->main_menu, 'status'=>$request->status]);
        Session::flash('success', 'Created Successfuly');

        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit')->with('category', $category);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'en_name' => 'required|max:15',
            'da_name' => 'required|max:15',
            'pa_name' => 'required|max:15',
            // 'main_menu' => 'required|boolean',
            // 'status' => 'required|boolean',
        ]);

       $category->en_name = $request->en_name;
       $category->da_name = $request->da_name;
       $category->pa_name = $request->pa_name;
       $category->main_menu = $request->main_menu;
       $category->status = $request->status;
       $category->updated_by = Auth::user()->id;
       $category->save();

        Session::flash('success', 'Created Successfuly');

        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('success', 'Deleted Successfuly');

        // return "deleted";
    }
}