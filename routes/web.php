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

use App\Task;
use Illuminate\Http\Request;
use Validator;

Route::get('/', 'Test_app@index');

Route::get('/home','Test_app@home');

Route::post('/task','Test_app@add_task');
Route::delete('/task/{task}', 'Test_app@delete_task');

Route::post('/task/{task}', 'Test_app@update_task');