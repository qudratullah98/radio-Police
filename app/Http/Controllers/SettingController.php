<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Throwable;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::findOrFail(1);
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {

        $setting = Setting::findOrFail(1);
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'en_nav_title' => 'required|max:30',
                'da_nav_title' => 'required|max:30',
                'pa_nav_title' => 'required|max:30',
                'en_nav_subtitle' => 'required|max:60',
                'da_nav_subtitle' => 'required|max:60',
                'pa_nav_subtitle' => 'required|max:60',
                'en_province' => 'required',
                'da_province' => 'required',
                'pa_province' => 'required',
                'en_street' => 'required|max:30',
                'da_street' => 'required|max:30',
                'pa_street' => 'required|max:30',
                'en_exact_address' => 'required|max:60',
                'da_exact_address' => 'required|max:60',
                'pa_exact_address' => 'required|max:60',
                'en_about_us' => 'required',
                'da_about_us' => 'required',
                'pa_about_us' => 'required',
                'map_location' => 'required',
                'phone' => 'required',
                'email' => 'required',

            ]);
            if ($request->hasFile('tab_icon')) {
                $setting->tab_icon = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('tab_icon'));
            } elseif ($request->hasFile('nav_logo')) {
                $setting->nav_logo = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('nav_logo'));
            }
            $setting->en_nav_title = $request->en_nav_title;
            $setting->da_nav_title = $request->da_nav_title;
            $setting->pa_nav_title = $request->pa_nav_title;
            $setting->en_nav_subtitle = $request->en_nav_subtitle;
            $setting->da_nav_subtitle = $request->da_nav_subtitle;
            $setting->pa_nav_subtitle = $request->pa_nav_subtitle;
            $setting->en_province = $request->en_province;
            $setting->da_province = $request->da_province;
            $setting->pa_province = $request->pa_province;
            $setting->en_street = $request->en_street;
            $setting->da_street = $request->da_street;
            $setting->pa_street = $request->pa_street;
            $setting->en_exact_address = $request->en_exact_address;
            $setting->da_exact_address = $request->da_exact_address;
            $setting->pa_exact_address = $request->pa_exact_address;
            $setting->en_about_us = $request->en_about_us;
            $setting->da_about_us = $request->da_about_us;
            $setting->pa_about_us = $request->pa_about_us;
            $setting->map_location = $request->map_location;
            $setting->phone = $request->phone;
            $setting->email = $request->email;
            $setting->updated_by = Auth::user()->id;
            $setting->save();
            DB::commit();
            Session::flash('success', 'Updated Successfuly');
            return redirect('setting');
        } catch (Throwable $e) {
            dd($e);
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
