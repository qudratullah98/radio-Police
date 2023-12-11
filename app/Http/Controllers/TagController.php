<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tag.index')->with('tags', Tag::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
        Tag::create(['created_by' => Auth::user()->id, 'en_name' => $request->en_name, 'da_name' => $request->da_name, 'pa_name' => $request->pa_name, 'status' => $request->status]);
        Session::flash('success', 'Created Successfuly');
        return redirect('tag');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit')->with('tag', $tag);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'en_name' => 'required|max:15',
            'da_name' => 'required|max:15',
            'pa_name' => 'required|max:15',
            // 'main_menu' => 'required|boolean',
            // 'status' => 'required|boolean',
        ]);

        $tag->en_name = $request->en_name;
        $tag->da_name = $request->da_name;
        $tag->pa_name = $request->pa_name;
        $tag->status = $request->status;
        $tag->updated_by = Auth::user()->id;
        $tag->save();

        Session::flash('success', 'Created Successfuly');

        return redirect('tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        Session::flash('success', 'Deleted Successfuly');
    }
}