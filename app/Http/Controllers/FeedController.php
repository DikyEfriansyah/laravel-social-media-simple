<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;


class FeedController extends Controller
{
    public function getDashboard()
    {   $suggestion = DB::table('users')
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

        $posts = Feed::orderBy('created_at', 'desc')->get();
        /*dd($following);*/
        return view('main', compact('posts', 'suggestion','count_following','count_followers','count_feeds','feeds'));
    }

    public function postCreatePost(Request $request)
    {
        $request->validate([
            'body' => 'required|max:1000',
            'img' => 'mimes:jpeg,jpg,png|max:2200'
        ]);
        
       
        if($request->has('img')){
            $gambar=$request->img;
            $new_gambar = time().'-'.$gambar->getClientOriginalName();
            Feed::create([
                'caption' => $request->body,
                'img'=> $new_gambar,
                'users_id' => Auth::User()->id
            ]);
            $gambar->move('uploads/feeds/',$new_gambar);
        }else{
            Feed::create([
                'caption' => $request->body,
                'users_id' => Auth::User()->id
            ]);
        }
        
        return redirect('/dashboard');


        /*$post->body = $request['body'];
        $message = 'There was an error';
        if ($request->user()->posts()->save($post)) {
            $message = 'Post successfully created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]); aslinya*/
    }
    public function getDeletePost($post_id)
    {

        $post = Feed::findorfail('feeds_id', $post_id)->first();

        $post->delete();
        return redirect()->route('/dashboard');
    }
    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post = Feed::find($request['feedsId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['feeds_id'];
        $is_like = $request['likes_id'] === 'true';
        $update = false;
        $post = Feed::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('feeds_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }

    public function getUserPost(){
        $posts =Feed::where('users_id','=', Auth::user()->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
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
    $suggestion = DB::table('users')
                        ->leftJoin('following','users.id', '=', 'following.following_id')
                        ->where('users.id','<>',Auth::user()->id)
                        ->where('following.following_id','=',NULL)
                        ->select('users.id','users.name','users.photo')
                        ->orderBy('users.id','asc')
                        ->get();
    $count_followers = count($followers);               
    $count_following = count($following);
    $count_sug = count($suggestion);
    $count_feeds = count($feeds);

        return view('users_feed', compact('posts','count_followers','count_following','count_feeds','suggestion'));
    }
}
