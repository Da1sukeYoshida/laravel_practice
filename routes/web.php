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

Route::get('/', function () {
    //return view('welcome');

    $tasks = Task::orderBy('updated_at', 'asc')->get();

    return view('tasks',[
      'tasks' => $tasks
    ]);
});

Route::get('/home',function(){
    return view('home');
});

Route::post('/task',function (Request $request){
        $validator = Validator::make($request->all(),[
          'name' => 'required|max:255',
        ]);

        if($validator->fails()){
          return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
});

Route::delete('/task/{task}', function(Task $task){
        $task->delete();

        return redirect('/');
});

Route::post('/task/{task}', function(Task $task, Request $request){
        $validator = Validator::make($request->all(),[
          'name' => 'required|max:255',
        ]);

        if($validator->fails()){
          return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }
        //$task->name = "abc";
        //$task->save();

        //$task->update(['name' => $task->name]);
        $task->update(['name' => $request->name]);

        return redirect('/');
});