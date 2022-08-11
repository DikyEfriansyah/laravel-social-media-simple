<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Feed;
use App\Post;
use App\User;
use Illuminate\Support\Facades\DB;

// use App\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment=Comment::all();
        return view('comment.index', compact('comment'));
        // $comment = Comment::orderBy('created_at', 'desc')->get();
        // return view('comment.index', ['comment' => $comment]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feeds=Feed::all();
        $users=User::all();
        return view('comment.create', compact('feeds', 'users'));
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
            "comment" => 'required'
        ]);
        //dd($request->all());

        $feeds=Comment::create([
            'comment'=>$request->comment,
            'feeds_id'=>$request->feed,
            'users_id'=>$request->user
        ]);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment=Comment::findorfail($id);
        return view('comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::all();
        $post=Feed::all();
        $comment=Comment::findorfail($id);
        // $films=compact('film','genre');
        // dd($films);
        return view('comment.edit', compact('comment','user','post'));
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
            "comment" => 'required',
        ]);

        //dd($request->all());
        $query = DB::table('comments')
            ->where('id', $id)
            ->update([
            'comment'=>$request['comment'],
        ]);

        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment=Comment::findorfail($id);
        $comment->delete();

        return redirect()->route('comment.index');
    }
}
