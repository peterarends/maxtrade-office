<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $projects = Project::where([['user_id', '=',  $request->user_id], ['title', 'LIKE', '%' . $request->search . '%']])
                ->orWhere([['user_id', '=', $request->user_id], ['body', 'LIKE', '%' . $request->search . '%']]);
            $projects = $projects->orderBy('title', 'asc');
            $projects = $projects->get();

            $projects_arr = [];
            foreach ($projects as $project) {
                $projects_arr[] = $project->id;
            }
            $tasks = Task::whereIn('project_id', $projects_arr);
            $tasks = $tasks->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('body', 'LIKE', '%' . $request->search . '%');
            $tasks = $tasks->orderBy('title', 'asc');
            $tasks = $tasks->get();

            $result = [
                "result" => "success",
                "projects" => $projects,
                "tasks" => $tasks
            ];
        } else {
            $result = [
                "result" => "unsuccess",
                "projects" => [],
                "tasks" => []
            ];
        }
        /** Return collection of Tasks as resource */
        return json_encode($result);
    }
}
