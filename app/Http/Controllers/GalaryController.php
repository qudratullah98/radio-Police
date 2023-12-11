<?php

namespace App\Http\Controllers;

use App\Models\Galary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

use Throwable;

class GalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.galary.index')->with('galaries', Galary::paginate(10));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galary.create');
        
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
            'en_title' => 'required|max:100',
            'da_title' => 'required|max:100',
            'pa_title' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'main_menu' => 'required|boolean',
            // 'status' => 'required|boolean',
        ]);


        DB::beginTransaction();
        try {


            $galary = Galary::create(['created_by' => Auth::user()->id, 'en_title' => $request->en_title, 'da_title' => $request->da_title, 'pa_title' => $request->pa_title, 'status' => $request->status]);

            $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
            $galary->image()->create(['image' => $image]);

            DB::commit();
            Session::flash('success', 'Created Successfuly');
            return redirect('galary');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galary  $galary
     * @return \Illuminate\Http\Response
     */
    public function show(Galary $galary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galary  $galary
     * @return \Illuminate\Http\Response
     */
    public function edit(Galary $galary)
    {
        $file = Image::where('imageable_id', $galary->id)->first();
        return view('admin.galary.edit', compact('galary', 'file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galary  $galary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galary $galary)
    {
        $request->validate([
            'en_title' => 'required|max:100',
            'da_title' => 'required|max:100',
            'pa_title' => 'required|max:100',
            // 'main_menu' => 'required|boolean',
            // 'status' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
                $galary->image()->update(['image' => $image]);
            }

            $galary->en_title = $request->en_title;
            $galary->da_title = $request->da_title;
            $galary->pa_title = $request->pa_title;
            $galary->status = $request->status;
            $galary->updated_by = Auth::user()->id;
            $galary->save();


            // $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
            // $galary->image()->update(['image' => $image]);


            DB::commit();
            Session::flash('success', 'Updated Successfuly');
            return redirect('galary');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galary  $galary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galary $galary)
    {
        $galary->delete();
        Session::flash('success', 'Deleted Successfuly');
    }
}