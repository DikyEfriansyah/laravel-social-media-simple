<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users','UsersController')->except(['store','create']); 
Route::resource('comment', 'CommentController');
Route::resource('follow', 'FollowController');

/*-- tambahan --*/

Route::get('/dashboard',[
    'uses'=> 'FeedController@getDashboard',
    'as'=>'dashboard'
])->middleware('auth');

Route::post('/createpost', [
    'uses' => 'FeedController@postCreatePost',
    'as' => 'post.create'
])->middleware('auth');


Route::get('/delete-post/{post_id}', [
    'uses' => 'FeedController@getDeletePost',
    'as' => 'post.delete'
])->middleware('auth');


Route::post('/like', [
    'uses' => 'FeedController@postLikePost',
    'as' => 'like'
]);

Route::post('/edit', [
    'uses' => 'FeedController@postEditPost',
    'as' => 'edit'
]);

Route::get('/show/{user_id}', [
    'uses' => 'FeedController@getUserPost',
    'as' => 'show'
])->middleware('auth');
/*--end tambahan --*/
});

Route::get('/', function () {
    return view('login');
});

Auth::routes(['verify'=>true]);

