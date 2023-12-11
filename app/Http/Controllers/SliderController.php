<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::orderby('id', 'desc')->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                
                
                ->addColumn('status', function ($data) {
                    
                    return $data->status ? ' <input class="form-check-input" type="radio" checked disabled>' : '<input class="form-check-input" type="radio" disabled>';
                    
                })
                ->addColumn('creation_date', function ($data) {
                    return date("Y-m-d", strtotime($data->created_at));
                })
                ->addColumn('action', function ($data) {
                    return '<a href="javascript:void(0)" class="btn btn-light-danger btn-sm delete fa fa-trash" id="' . $data->id . '"></a>
                    &nbsp; | &nbsp;
                    <a href="' .  route('slider.edit', ['slider' => $data->id]) . '" class="btn btn-light-primary btn-sm fa fa-edit"></a>';
                })
                ->escapeColumns([])
                ->rawColumns(['status'])
                // ->rawColumns(['creation_date'])
                // ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.slider.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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


            $slider = Slider::create(['created_by' => Auth::user()->id, 'en_title' => $request->en_title, 'da_title' => $request->da_title, 'pa_title' => $request->pa_title, 'status' => $request->status]);

            $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
            $slider->image()->create(['image' => $image]);

            DB::commit();
            Session::flash('success', 'Created Successfuly');
            return redirect('slider');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $file = Image::where('imageable_id', $slider->id)->first();
        return view('admin.slider.edit', compact('slider', 'file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
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
                $slider->image()->update(['image' => $image]);
            }

            $slider->en_title = $request->en_title;
            $slider->da_title = $request->da_title;
            $slider->pa_title = $request->pa_title;
            $slider->status = $request->status;
            $slider->updated_by = Auth::user()->id;
            $slider->save();


            // $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
            // $slider->image()->update(['image' => $image]);


            DB::commit();
            Session::flash('success', 'Updated Successfuly');
            return redirect('slider');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        Session::flash('success', 'Deleted Successfuly');
    }
}
