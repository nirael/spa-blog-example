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
use \App\Events\BanListEvent;
use Illuminate\Support\Facades\Cache;
use \App\Comment;
use Illuminate\Http\Request as R;

Route::get('/','HomeController@main');

Auth::routes();
Route::get('/adminpanel','HomeController@panel')->middleware('auth');

Route::post('/stadd','FileController@store');
Route::get('/getimages','FileController@getimages');
Route::post('/deletefile','FileController@deleteImage');

Route::get('/ips',function(){
	$ips = collect(Comment::all(['ip'])->toArray())->unique();
	return  response()->json(['ips' => $ips]);
})->middleware('auth');
Route::get('/banned',function(){
	return response()->json(['banned' => Cache::get('banned',null)]);
})->middleware('auth');

Route::any('/ban',"CommentController@ban")->middleware('auth');
Route::any('/unban',"CommentController@unban")->middleware('auth');


Route::resource('/posts','PostController',['only' => ['index','show']]);
Route::resource('/posts','PostController',['only' => ['store','update','destroy'],'middleware' => 'auth']);
Route::get('/posts/{id}/comments','PostController@comments');
Route::get('/posts/{id}/category','PostController@category');
Route::get('/recent','PostController@recent');

Route::resource('/categories','CategoryController',['only' => ['index','show']]);
Route::resource('/categories','CategoryController',['only' => ['store','update','destroy'],'middleware' => 'auth']);
Route::get("/categories/{id}/posts","CategoryController@posts");

Route::resource('/comments','CommentController',['only' => ['index','show','store']]);
Route::resource('/comments','CommentController',['only' => ['update','destroy'],'middleware' => 'auth']);
Route::get('/comments/forpost/{id}','CommentController@forpost');

Route::match(['get','post'],'/unit1','HomeController@unit1');
