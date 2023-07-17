<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CreateRequest, DeleteRequest};
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * @param CreateRequest $request
     *
     * @return JsonResponse
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $task = Task::create($request->only(['content', 'completed']));

        if ($request->has('categories')) {
            $task->categories()->sync($request->get('categories'));
        }

        $task->load('categories');

        return response()->json($task);
    }

    /**
     * @param DeleteRequest $request
     *
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request): JsonResponse
    {
        Task::destroy($request->only('id'));

        return response()->json($request->validated());
    }
}
