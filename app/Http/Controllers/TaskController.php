<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();
        $sort = $request->query('sort', 'id'); // Get the sorting parameter from the request, default to 'title' if not provided

        $userId = $request->query('user'); // Get the user ID filter parameter from the request

        $tasks = Task::when($userId, function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->orderBy($sort)->paginate(5); // Filter tasks by user ID (if provided) and order by 'title'
    
        $users = User::all(); // Retrieve all users for the filter dropdown
        return view('tasks.index', compact('tasks','users'));
    }

    public function create(Request $request)
    {
        // Check if the user is authenticated
     if (!$request->user()) {
        return redirect()->route('login'); // Redirect to the login page
    }
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->finish =$request->finish;
        $task->details = $request->details;
        $task->user_id = $request->user()->id;
        $task->save();

         return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    public function edit(Task $task, Request $request)
    {
           // Check if the user is authenticated
     if (!$request->user()) {
        return redirect()->route('login'); // Redirect to the login page
    }
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $task->title = $request->title;
        // Update other task properties as needed
        $task->save();
        
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task, Request $request)
    {
              // Check if the user is authenticated
     if (!$request->user()) {
        return redirect()->route('login'); // Redirect to the login page
    }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
    public function complete(Task $task)
{
    $task->completed = true;
    $task->save();
    
    return redirect()->route('tasks.index')->with('success', 'Task marked as complete.');
}
    
}
