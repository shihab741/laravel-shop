<?php

namespace App\Http\Controllers;

use App\StaticPage;
use Image;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = StaticPage::all();
        return view('admin.page.page', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $directory = 'uploads/page-images/';
        $imageUrl = $directory.$imageName;

        while(file_exists($imageUrl))
        {
            $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
            $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
            $imageUrl = $directory.$imageName;
        }

        Image::make($image)->resize(900,300)->save($imageUrl);

        $staticPage = new StaticPage();
        $staticPage->url = $request->url;
        $staticPage->heading = $request->heading;
        $staticPage->image = $imageName;
        $staticPage->page_content = $request->page_content;
        $staticPage->status = $request->status;
        $staticPage->save();

        return redirect('page')->with('message', '<div class="alert alert-success" role="alert">Page added successfully!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staticPage = StaticPage::find($id);
        return view('admin.page.edit', ['page' => $staticPage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function edit(StaticPage $staticPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $staticPage = StaticPage::find($request->id);
        $image = $request->file('image');

        if ($image) 
        {
            unlink('uploads/page-images/'.$staticPage->image);

            $imageName = $image->getClientOriginalName();
            $directory = 'uploads/page-images/';
            $imageUrl = $directory.$imageName;

            while(file_exists($imageUrl))
            {
                $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
                $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
                $imageUrl = $directory.$imageName;
            }            

            Image::make($image)->resize(900,300)->save($imageUrl);

            $staticPage->url = $request->url;
            $staticPage->heading = $request->heading;
            $staticPage->image = $imageName;
            $staticPage->page_content = $request->page_content;
            $staticPage->status = $request->status;
            $staticPage->save();
        } 
        else 
        {
            $staticPage->url = $request->url;
            $staticPage->heading = $request->heading;
            $staticPage->page_content = $request->page_content;
            $staticPage->status = $request->status;
            $staticPage->save();
        }

        return redirect('page')->with('message', '<div class="alert alert-success" role="alert">Page updated successfully!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staticPage = StaticPage::find($id);
        if($staticPage->image)
        {
            unlink('uploads/page-images/'.$staticPage->image);
            $staticPage->delete();
        }
        else
        {
            $staticPage->delete();
        }
        
        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Page deleted successfully!</div>');
    }

    public function publish($id)
    {
        $staticPage = StaticPage::find($id);
        $staticPage->status = 1;
        $staticPage->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert"> Published successfully!</div>');
    }

    public function unpublish($id)
    {
        $staticPage = StaticPage::find($id);
        $staticPage->status = 0;
        $staticPage->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Unublished successfully!</div>');
    }

}
