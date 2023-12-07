<?php

namespace App\Services;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskService
{
    public function all(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::get());
    }

    public function show(int $id): TaskResource|JsonResponse
    {
        $task = Task::find($id);
        if(!$task) {
            return response()->json(['message' => 'Task not found']);
        }

        return new TaskResource($task);
    }

    public function create(TaskCreateRequest $request): TaskResource
    {
        return new TaskResource(Task::create($request->all()));
    }

    public function update(TaskUpdateRequest $request, int $id): TaskResource|JsonResponse
    {
        $task = Task::find($id);
        if(!$task) {
            return response()->json(['message' => 'Task not found']);
        }
        $task->fill($request->all());
        $task->save();

        return new TaskResource($task);
    }

    public function delete(int $id): JsonResponse
    {
        $task = Task::find($id);
        if(!$task) {
            return response()->json(['message' => 'Task not found']);
        }
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
