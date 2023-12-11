<?php

namespace App\Http\Controllers;

use App\Models\DayOfWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DayOfWeekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.day_of_week.index')->with('day_of_weeks', DayOfWeek::paginate(10));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.day_of_week.create');

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
        DayOfWeek::create(['created_by' => Auth::user()->id, 'en_name' => $request->en_name, 'da_name' => $request->da_name, 'pa_name' => $request->pa_name, 'status' => $request->status]);
        Session::flash('success', 'Created Successfuly');
        return redirect('day_of_week');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DayOfWeek  $dayOfWeek
     * @return \Illuminate\Http\Response
     */
    public function show(DayOfWeek $dayOfWeek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DayOfWeek  $dayOfWeek
     * @return \Illuminate\Http\Response
     */
    public function edit(DayOfWeek $dayOfWeek)
    {
        return view('admin.day_of_week.edit')->with('day_of_week', $dayOfWeek);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DayOfWeek  $dayOfWeek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DayOfWeek $dayOfWeek)
    {
        $request->validate([
            'en_name' => 'required|max:15',
            'da_name' => 'required|max:15',
            'pa_name' => 'required|max:15',
            // 'main_menu' => 'required|boolean',
            // 'status' => 'required|boolean',
        ]);

        $dayOfWeek->en_name = $request->en_name;
        $dayOfWeek->da_name = $request->da_name;
        $dayOfWeek->pa_name = $request->pa_name;
        $dayOfWeek->status = $request->status;
        $dayOfWeek->updated_by = Auth::user()->id;
        $dayOfWeek->save();

        Session::flash('success', 'Created Successfuly');

        return redirect('day_of_week');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DayOfWeek  $dayOfWeek
     * @return \Illuminate\Http\Response
     */
    public function destroy(DayOfWeek $dayOfWeek)
    {
        $dayOfWeek->delete();
        Session::flash('success', 'Deleted Successfuly');
    }
}