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


use App\Events\TestEvent1;

Auth::routes();

//Route::group(['middleware' => ['check']], function (){
//
//});
Route::get('/home', 'HomeController@index');

Route::get('/room/{room_id}', 'ChatController@showRoom' );
Route::get('/', 'HomeController@main' );
Route::post('/chat/message', 'ChatController@postMessage' );


//
//
//Route::get('/messages', function (){
//    return App\Message::with('user')->get();
//} );

//Route::post('/messages', function (){
//    $user = Auth::user();
//
//    $user->messages()->create([
//       'message' => request()->get('message')
//    ]);
//
//    return response('sucsses');
//} );

//Route::get('/event', function (){
//    event(
//        new TestEvent1()
//    );
//} );
//
//Route::get('/prediss', function (){
//    print_r(app()->make('redis'));
//} );
