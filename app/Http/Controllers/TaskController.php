<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CompleteRequest, CreateRequest, DeleteRequest};
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
        $task = Task::find($request->get('id'));
        $task->delete();

        return response()->json($task);
    }

    /**
     * @param CompleteRequest $request
     *
     * @return JsonResponse
     */
    public function complete(CompleteRequest $request): JsonResponse
    {
        $task = Task::find($request->get('id'));
        $task->completed = $request->get('completed');
        $task->save();

        $task->load('categories');

        return response()->json($task);
    }
}
