<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
    
        $tasks = Task::where('user_id', $user->id)->get();
    
        return response()->json($tasks, 200);
    }
    public function getTasks()
    {
        return response()->json((Task::all()),200);
    }
    public function apiTasks()
    {
        $userId = Auth::id();
        $tasks = Task::where('user_id', $userId)->get();

        return response()->json($tasks); // Return tasks as JSON
    }
    public function read()
    {
        $userId = Auth::id();

        $tasks = Task::where('user_id', $userId)->get();
        $statusOptions = Task::distinct()->pluck('status');

        // Return the view with the user's tasks
        return view('NormalUser.tasks')->with([
            'tasks' => $tasks,
            'statusOptions' => $statusOptions,
        ]);
        // $tasks = Task::all();
        // return view ("NormalUser/tasks")->with(["tasks"=>$tasks]);
    }
    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'taskId' => 'required|exists:tasks,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required',


        ]);

        Task::where('id', $validatedData['taskId'])->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
        ]);

        return redirect('/tasks')->with('success', 'Task updated successfully!');
    }
    public function store(Request $request)
    {
        $taskRow = new Task;
        $taskRow->title = $request->input('add-title');
        $taskRow->description = $request->get('add-description');
        $taskRow->status = $request->get('add-status');
        $taskRow->user_id = Auth::id();

        $taskRow->save();
        return redirect('/tasks')->with('success', 'Task Added successfully!');
        ;
        //
    }
}
