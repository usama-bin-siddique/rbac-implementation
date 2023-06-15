<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteTaskRequest;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index()
    {
        $authUser = auth()->user();
        if ($authUser?->hasRole('admin')) {
            $tasks = Task::query()->with('user:id,name')->latest()->get();
        } else {
            $tasks = Task::query()->where('user_id', '=', $authUser->id)->with('user:id,name')->latest()->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function create()
    {
        return view('tasks.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTaskRequest $request)
    {
        $task = auth()->user()->tasks()->create($request->validated());

        if ($task) {
            return Redirect::route('tasks.create')->with('status', 'data-saved');
        }
        return Redirect::route('tasks.create')->with('error', 'data-saved');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function edit(Task $task)
    {
        return view('tasks.form', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validatedData = $request->validated();
        $task->update($validatedData);

        return Redirect::route('tasks.edit', $task)->with('status', 'data-saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteTaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(DeleteTaskRequest $request, Task $task)
    {
        if ($task->user_id === auth()->user()->id && auth()->user()->hasRole('user')) {
            $task->delete();
        } else {
            $task->delete();
        }
        return Redirect::route('tasks.index', $task)->with('status', 'data-deleted');
    }
}
