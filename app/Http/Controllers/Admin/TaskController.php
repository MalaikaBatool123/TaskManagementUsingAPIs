<?php

namespace App\Http\Controllers\Admin;

use TCG\Voyager\Http\Controllers\VoyagerBaseController; 
use App\Models\Task; 
use Illuminate\Http\Request;

class TaskController extends VoyagerBaseController
{
    public function index(Request $request)
    {
        $tasks = Task::all();
        return view('voyager::tasks.browse', compact('tasks'));  
    }
}
