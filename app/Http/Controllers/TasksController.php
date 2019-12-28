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

    public function search($project_id, Request $request)
    {
        /** Get Tasks */
        if (!empty($request->search)) {
            $tasks = Task::where(['project_id' => $project_id]);
            $tasks = $tasks
                ->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('body', 'LIKE', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')->get();
        } else {
            $tasks = Task::where(['project_id' => $project_id])->orderBy('created_at', 'desc')->get();
        }
        /** Return collection of Tasks as resource */
        return TaskResource::collection($tasks);
    }

    public function indexActive($project_id)
    {
        /** Get only active Tasks */
        $tasks = Task::where(['project_id' => $project_id])->where(['status' => 1])->orderBy('created_at', 'desc')->get();

        /** Return collection of Tasks as resource */
        return TaskResource::collection($tasks);
    }

    public function indexEnded($project_id)
    {
        /** Get only ended Tasks */
        $tasks = Task::where(['project_id' => $project_id])->where(['status' => 0])->orderBy('created_at', 'desc')->get();

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

    public function addFile($id)
    {
        $result = "unsucess";
        if (!empty($id)) {
            @mkdir('images/tasks/' . $id, 0755, true);
            $uploaddir = 'images/tasks/' . $id . '/';
            $check = (
                (isset($_FILES['file'])) &&
                (($_FILES['file']["type"] == "application/pdf") ||
                    ($_FILES['file']["type"] == "application/msword") ||
                    ($_FILES['file']["type"] == "application/vnd.ms-excel") ||
                    ($_FILES['file']["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") ||
                    ($_FILES['file']["type"] == "application/vnd.ms-powerpoint") ||
                    ($_FILES['file']["type"] == "text/plain") ||
                    ($_FILES['file']["type"] == "text/html") ||
                    (getimagesize($_FILES['file']['tmp_name'])) ||
                    ($_FILES['file']["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")) &&
                ($_FILES['file']["size"] < 307200));
            if ($check !== false) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir . $_FILES['file']['name'])) {
                    $result = "success";
                }
            } else {
                if (!isset($_FILES['file'])) {
                    $result = "no file";
                } else {
                    if ($_FILES['file']["size"] >= 307200) {
                        $result = "exceed file size";
                    } else {
                        $result = "wrong file type";
                    }
                }
            }
        }

        /** Return a single task as resource */
        return json_encode(["result" => $result]);
    }
}