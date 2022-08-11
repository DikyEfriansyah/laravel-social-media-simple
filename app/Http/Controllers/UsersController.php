<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users; 
use DB;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.users');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suggestion = DB::table('users')
                        ->leftJoin('following','users.id', '=', 'following.following_id')
                        ->where('users.id','<>',Auth::user()->id)
                        ->where('following.following_id','=',NULL)
                        ->select('users.id','users.name','users.photo')
                        ->orderBy('users.id','asc')
                        ->get();
        $following = DB::table('users')
                        ->join('following','users.id', '=', 'following.users_id')
                        ->where('following.users_id','=', Auth::user()->id)
                        ->select('users.id','users.name','users.photo')
                        ->orderBy('users.id','asc')
                        ->get();
        $followers = DB::table('users')
                        ->leftJoin('following','users.id', '=', 'following.following_id')
                        ->where('following.following_id','=',Auth::user()->id)
                        ->select('users.id','users.name','users.photo')
                        ->orderBy('users.id','asc')
                        ->get();
        $feeds=DB::table('feeds')
                  ->where('users_id','=',Auth::user()->id)
                  ->get();
        $count_followers = count($followers);               
        $count_following = count($following);
        $count_sug = count($suggestion);
        $count_feeds = count($feeds);
        $users =Users::findorfail($id);
        return view('users.users',compact('users','suggestion','count_sug','count_followers','count_following','count_feeds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'photo' => 'mimes:jpeg,jpg,png|max:2200'
        ]);
        

        $user=Users::findorfail($id);

        if($request->has('photo')){
            $path="uploads/avatar/";
            File::delete($path . $user->photo);

            $gambar = $request->photo;
            $new_gambar = time(). '-'. $gambar->getClientOriginalName();
            $gambar->move('uploads/avatar/',$new_gambar);
            $user_data =[
                'name' => $request->name,
                'email' => $request->email,
                'date_birth' => $request->date_birth,
                'address' => $request->address,
                'bio' => $request->bio,
                'photo'=> $new_gambar
            ];
        } else{
            $user_data =[
                'name' => $request->name,
                'email' => $request->email,
                'date_birth' => $request->date_birth,
                'address' => $request->address,
                'bio' => $request->bio
            ];
        }
        $user->update($user_data);
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
