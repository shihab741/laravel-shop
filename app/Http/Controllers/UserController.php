<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use Auth;

class UserController extends Controller
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
        $users = User::all();
        return view('admin.user.user',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('photo');
        $imageName = $image->getClientOriginalName();
        $directory = 'uploads/user-images/';
        $imageUrl = $directory.$imageName;

        while(file_exists($imageUrl))
        {
            $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
            $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
            $imageUrl = $directory.$imageName;
        }

        Image::make($image)->resize(300,300)->save($imageUrl);

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->photo = $imageName;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->remember_token = str_random(10);
        $user->save();

        return redirect('user')->with('message', '<div class="alert alert-success" role="alert">User added successfully!</div>');                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $image = $request->file('photo');

        if($request->password)
        {
            if($image)
            {
                unlink('uploads/user-images/'.$user->photo);

                $imageName = $image->getClientOriginalName();
                $directory = 'uploads/user-images/';
                $imageUrl = $directory.$imageName;

                while(file_exists($imageUrl))
                {
                    $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
                    $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
                    $imageUrl = $directory.$imageName;
                }

                Image::make($image)->resize(300,300)->save($imageUrl);   
     
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->address = $request->address;
                $user->photo = $imageName;
                $user->role = $request->role;
                $user->status = $request->status;
                $user->remember_token = str_random(10);
                $user->save();           
            }
            else
            {
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->address = $request->address;
                $user->role = $request->role;
                $user->status = $request->status;
                $user->remember_token = str_random(10);
                $user->save();
            }
        }
        else
        {
            if($image)
            {
                unlink('uploads/user-images/'.$user->photo);

                $imageName = $image->getClientOriginalName();
                $directory = 'uploads/user-images/';
                $imageUrl = $directory.$imageName;

                while(file_exists($imageUrl))
                {
                    $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
                    $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
                    $imageUrl = $directory.$imageName;
                }

                Image::make($image)->resize(300,300)->save($imageUrl);   
     
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->address = $request->address;
                $user->photo = $imageName;
                $user->role = $request->role;
                $user->status = $request->status;
                $user->remember_token = str_random(10);
                $user->save();           
            }
            else
            {
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->address = $request->address;
                $user->role = $request->role;
                $user->status = $request->status;
                $user->remember_token = str_random(10);
                $user->save();
            }
        }
        
        return redirect('user')->with('message', '<div class="alert alert-success" role="alert">User information updated successfully!</div>');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->photo)
        {
            unlink('uploads/user-images/'.$user->photo);
            $user->delete();
        }
        else
        {
            $user->delete();
        }
        
        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">User deleted successfully!</div>');
    }

    public function publish($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert"> Activated successfully!</div>');
    }

    public function unpublish($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Deactivated successfully!</div>');
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.user.profile', ['user' => $user]);
    }

}
