<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommentsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/blogs', 'BlogsController@index');
Route::get('/blogs/{id}', 'BlogsController@show');

Route::get('/users', 'UsersController@index');
Route::get('/users/{id}', 'UsersController@show');
Route::post('/users', 'UsersController@store');

Route::get('/comments', 'CommentsController@index');
Route::get('/comments/{id}', 'CommentsController@show');
Route::post('/comments', 'CommentsController@store');