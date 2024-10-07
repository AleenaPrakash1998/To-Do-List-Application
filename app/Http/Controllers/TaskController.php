<?php

namespace App\Http\Controllers;

use App\DataTables\TasksDataTable;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{

    public function index(TasksDataTable $dataTable)
    {
        return $dataTable->render('pages.tasks.index');
    }


    public function create(): View
    {
        return view('pages.tasks.create');
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        Task::create($validatedData);

        return response()->json(['success' => true]);

    }


    public function edit($id): View
    {
        $task = Task::query()->findOrFail($id);

        return view('pages.tasks.edit', compact('task'));
    }


    public function update(UpdateTaskRequest $request, string $id): JsonResponse
    {
        $validatedData = $request->validated();

        $task = Task::findOrFail($id);

        $task->update($validatedData);

        return response()->json(['success' => true]);

    }


    public function destroy(string $id): RedirectResponse
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
