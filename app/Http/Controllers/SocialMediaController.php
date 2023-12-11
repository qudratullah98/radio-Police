<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Throwable;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.social_media.index')->with('social_medias', SocialMedia::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.social_media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'en_title' => 'required|max:30',
                'da_title' => 'required|max:30',
                'pa_title' => 'required|max:30',
                'url' => 'required',
            ]);
            SocialMedia::create([
                'created_by' => Auth::user()->id,
                'en_title' => $request->en_title,
                'da_title' => $request->da_title,
                'pa_title' => $request->pa_title,

                'url' => $request->url,
                'status' => $request->status,
                'backgroundImage' => Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('backgroundImage')),
                'socialMediaIcon' => Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('socialMediaIcon')),
            ]);
            DB::commit();
            Session::flash('success', 'Created Successfuly');
            return redirect('social_media');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function show(SocialMedia $socialMedia)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialMedia $socialMedia)
    {

        try {
            $social_media = $socialMedia;
            return view('admin.social_media.edit', compact('social_media'));
        } catch (Throwable $e) {
            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialMedia $socialMedia)
    {
        $request->validate([
            'en_title' => 'required|max:30',
            'da_title' => 'required|max:30',
            'pa_title' => 'required|max:30',
            'url' => 'required',
        ]);


        DB::beginTransaction();
        try {
            if ($request->hasFile('socialMediaIcon')) {
                $socialMedia->socialMediaIcon = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('socialMediaIcon'));
            } elseif ($request->hasFile('backgroundImage')) {
                $socialMedia->backgroundImage = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('backgroundImage'));
            }

            $socialMedia->en_title = $request->en_title;
            $socialMedia->da_title = $request->da_title;
            $socialMedia->pa_title = $request->pa_title;
            $socialMedia->url = $request->url;
            $socialMedia->updated_by = Auth::user()->id;
            $socialMedia->status = $request->status;
            $socialMedia->save();

            DB::commit();
            Session::flash('success', 'Updated Successfuly');
            return redirect('social_media');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedia $socialMedia, Request $request)
    {
        $socialMedia->delete();
        Session::flash('success', 'Deleted Successfuly');
    }
}
