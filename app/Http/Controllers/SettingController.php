<?php

namespace App\Http\Controllers;

use App\Setting;
use Image;
use Auth;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::find(1);
        return view('admin.settings.edit', ['settings' => $settings]);
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
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings = Setting::find(1);
        $image = $request->file('logo');

        if($image)
        {
            unlink('uploads/settings-images/'.$settings->logo);

            $imageName = $image->getClientOriginalName();
            $directory = 'uploads/settings-images/';
            $imageUrl = $directory.$imageName;

            while(file_exists($imageUrl))
            {
                $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
                $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
                $imageUrl = $directory.$imageName;
            }            

            Image::make($image)->resize(100,80)->save($imageUrl);

            $settings->site_name = $request->site_name;
            $settings->phone = $request->phone;
            $settings->email = $request->email;
            $settings->address = $request->address;
            $settings->logo = $imageName;
            $settings->product_per_page = $request->product_per_page;
            $settings->save();
        }
        else
        {
            $settings->site_name = $request->site_name;
            $settings->phone = $request->phone;
            $settings->email = $request->email;
            $settings->address = $request->address;
            $settings->product_per_page = $request->product_per_page;
            $settings->save();
        }
        return redirect('dashboard')->with('message', '<div class="alert alert-success" role="alert">Settings  updated successfully!</div>');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
