<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Resources\Tasks as TaskResource;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        /** Get Tasks */
        $tasks = Task::where(['project_id' => $project_id])->orderBy('created_at', 'desc')->get();

        /** Return collection of Tasks as resource */
        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = $request->isMethod('put') ? Task::findOrFail($request->task_id) : new Task;

        $task->project_id = $request->input('project_id');
        $task->title = $request->input('title');
        $task->body = $request->input('body');
        $task->status = $request->input('status');

        if ($task->save()) {
            return new TaskResource($task);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** Get a Task */
        $task = Task::findOrFail($id);

        /** Return a single task as resource */
        return new TaskResource($task);
    }

    public function complete($id)
    {
        /** Complete all Tasks by Project */
        $tasks = Task::where(['project_id' => $id])->update(array('status' => 0));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** Get a Task */
        $task = Task::findOrFail($id);

        if ($task->delete()) {
            return new TaskResource($task);
        }
    }
}
