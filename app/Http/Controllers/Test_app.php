<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Task;

class Test_app extends Controller
{
    function home(){
        return view('home');
    }

    function index(){ 
        $tasks = Task::orderBy('updated_at', 'asc')->get();

        return view('tasks',[
        'tasks' => $tasks
        ]);
    }
    
    function add_task(Request $request){
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
    }

    function delete_task(Task $task){
        $task->delete();
        return redirect('/');
    }

    function update_task(Task $task, Request $request){
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
    }
}
