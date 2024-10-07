<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskShareController extends Controller
{
    public function showShareForm(Task $task)
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('pages.tasks.share', compact('task', 'users'));
    }


    public function shareTask(Request $request, Task $task)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Assuming there's a many-to-many relationship between tasks and users for sharing
        $task->sharedUsers()->attach($request->user_id);

        return redirect()->route('tasks.index')->with('success', 'Task shared successfully!');
    }
}
