<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    // public function getTasks()
    // {
    //     $userId = Auth::id();
    //     $tasks = Task::where('user_id', $userId)->get();
    //     // $tasks=Task::all();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Tasks retrieved successfully',
    //         'data' => $tasks
    //     ]);
    // }
    public function getTasks()
    {
        $userId = Auth::id();
        $tasks = Task::where('user_id', $userId)->get();

        return view('tasks', compact('tasks')); // Return the view with the data
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $task = Task::create($request->all()); // Use $request->all() if all fields are fillable

            return response()->json([
                'success' => true,
                'message' => 'Task Created Successfully',
                'data' => $task,
            ], 200); // 201 Created is the standard status for successful resource creation

        } catch (\Exception $e) { //Catch any exceptions to provide more descriptive error messages
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong',
                'error' => $e->getMessage(), //Include the error message for debugging
            ], 500);
        }
    }
    public function show($id)
    {

        try {
            $task = Task::find($id);
            return response()->json([
                'success' => true,
                'message' => 'Task displayed',
                'data' => $task,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No such task found',
                'error' => $e->getMessage(), //Include the error message for debugging
            ], 404);
        }

    }
    public function edit($id){
        
        try {
            $task = Task::find($id);
            
        $statusOptions = Task::distinct()->pluck('status');
            return response()->json([
                'success' => true,
                'message' => 'Task displayed',
                'data' => $task,
                'statusOptions'=>$statusOptions
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No such task found',
                'error' => $e->getMessage(), //Include the error message for debugging
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]); // Removed user_id validation assuming it's automatically handled.

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()->toArray(),
            ], 422);
        }

        try {
            $task = Task::find($id);

            if (!$task) {
                return response()->json([
                    'success' => false,
                    'message' => 'Task not found',
                ], 404);
            }

            // Use $validator->validated() instead of $request->validated()
            $task->update($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Task updated Successfully',
                'data' => $task,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function delete($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'No task Found',
            ], 404);
        } else {
            $task->delete();
        }

    }
}
