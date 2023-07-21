<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());

        $user = User::find($request->user_id);

        $user->notify(new TaskAssigned($task, $request->user()));

        return response()->json(['message' => 'Task Added.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $user_id = $task->user_id;

        $task->update($request->validated());

        if ($request->user_id !== $user_id) {
            $task->user->notify(new TaskAssigned($task, $request->user()));
        }

        return response()->json(['message' => 'Task Updated.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task Deleted.']);
    }
}
