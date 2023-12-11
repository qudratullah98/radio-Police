<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.video.index')->with('videos', Video::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
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
            'en_title' => 'required|max:15',
            'da_title' => 'required|max:15',
            'pa_title' => 'required|max:15',
            'url' => 'required',
        ]);
        Video::create(['created_by' => Auth::user()->id, 'en_title' => $request->en_title, 'da_title' => $request->da_title, 'pa_title' => $request->pa_title, 'url' => $request->url, 'status' => $request->status]);
        Session::flash('success', 'Created Successfuly');
        return redirect('video');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.video.edit')->with('video', $video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'en_title' => 'required|max:15',
            'da_title' => 'required|max:15',
            'pa_title' => 'required|max:15',
            'url' => 'required',
        ]);

        $video->en_title = $request->en_title;
        $video->da_title = $request->da_title;
        $video->pa_title = $request->pa_title;
        $video->url = $request->url;
        $video->status = $request->status;

        $video->updated_by = Auth::user()->id;
        $video->save();

        Session::flash('success', 'Created Successfuly');

        return redirect('video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        Session::flash('success', 'Deleted Successfuly');
    }
}
