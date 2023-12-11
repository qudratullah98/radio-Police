<?php

namespace App\Http\Controllers;

use App\Models\DayOfWeek;
use App\Models\Image;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.program.index')->with('programs', Program::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $day_of_weeks = DayOfWeek::all();
        return view('admin.program.create', compact('day_of_weeks'));
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
            'en_title' => 'required|max:30',
            'da_title' => 'required|max:30',
            'pa_title' => 'required|max:30',

            'en_sub_title' => 'required|max:60',
            'da_sub_title' => 'required|max:60',
            'pa_sub_title' => 'required|max:60',

            'en_description' => 'required',
            'da_description' => 'required',
            'pa_description' => 'required',

            'start' => 'required',
            'end' => 'required',

            'image' => 'required',
            'day_of_week' => 'required|array',
            // 'main_menu' => 'required|boolean',
            // 'status' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {
            $program = Program::create([
                'en_title' => $request->en_title,
                'da_title' => $request->da_title,
                'pa_title' => $request->pa_title,

                'en_sub_title' => $request->en_sub_title,
                'da_sub_title' => $request->da_sub_title,
                'pa_sub_title' => $request->pa_sub_title,

                'en_description' => $request->en_description,
                'da_description' => $request->da_description,
                'pa_description' => $request->pa_description,

                'start' => $request->start,
                'end' => $request->end,

                'status' => $request->status,
                'created_by' => Auth::user()->id
            ]);

            $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
            $program->images()->create(['image' => $image]);
            $program->day_of_weeks()->attach($request->day_of_week);

            DB::commit();
            Session::flash('success', 'Created Successfuly');
            return redirect('program');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        try {
            $day_of_weeks = DayOfWeek::all();
            $day_of_week_programs = DB::table('day_of_week_programs')->where('program_id', $program->id)->get();

            $file = Image::where('imageable_id', $program->id)->first();

            return view('admin.program.edit', compact('program', 'day_of_weeks', 'day_of_week_programs', 'file'));
        } catch (Throwable $e) {
            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'en_title' => 'required|max:30',
            'da_title' => 'required|max:30',
            'pa_title' => 'required|max:30',
            'en_sub_title' => 'required|max:60',
            'da_sub_title' => 'required|max:60',
            'pa_sub_title' => 'required|max:60',
            'en_description' => 'required',
            'da_description' => 'required',
            'pa_description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'day_of_week' => 'required|array',

        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
            $program->images()->update(['image' => $image]);
        }

        DB::beginTransaction();
        try {
            $program->en_title = $request->en_title;
            $program->da_title = $request->da_title;
            $program->pa_title = $request->pa_title;

            $program->en_sub_title = $request->en_sub_title;
            $program->da_sub_title = $request->da_sub_title;
            $program->pa_sub_title = $request->pa_sub_title;

            $program->en_description = $request->en_description;
            $program->da_description = $request->da_description;
            $program->pa_description = $request->pa_description;

            $program->start = $request->start;
            $program->end = $request->end;

            $program->updated_by = Auth::user()->id;
            $program->status = $request->status;
            $program->save();
            $program->day_of_weeks()->sync($request->day_of_week);

            DB::commit();
            Session::flash('success', 'Updated Successfuly');
            return redirect('program');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();
        Session::flash('success', 'Deleted Successfuly');
    }
}
