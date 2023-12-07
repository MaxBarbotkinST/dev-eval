<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TasksController extends Controller
{
    public function __construct(private readonly TaskService $taskService)
    {
    }
    public function index(): AnonymousResourceCollection
    {
        return $this->taskService->all();
    }

    public function show(int $id): TaskResource|JsonResponse
    {
        return $this->taskService->show($id);
    }

    public function store(TaskCreateRequest $request): TaskResource
    {
        return $this->taskService->create($request);
    }

    public function update(TaskUpdateRequest $request, $id): TaskResource|JsonResponse
    {
        return $this->taskService->update($request, $id);
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->taskService->delete($id);
    }
}
