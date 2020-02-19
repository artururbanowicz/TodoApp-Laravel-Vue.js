<?php

namespace TaskApp\Http\Controllers;

use Illuminate\Http\Request;
use TaskApp\Task;
class TaskController extends Controller
{
    public function storeTask(Request $request){
        $task= new Task();
        $task->name = $request->name;
        $task->save();
        return $task;
    }

    public function getTasks(){
        $tasks = Task::all();
        return $tasks;
    }

    public function deleteTask(Request $request){
        $task = Task::find($request->id)->delete();
    }

    public function editTask(Request $request, $id){
        $task = Task::where('id', $id)->first();
        $task->name = $request->get('val1');
        $task->save();
        return $task;
    }
}

