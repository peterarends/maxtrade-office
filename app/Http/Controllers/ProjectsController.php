<?php

namespace App\Http\Controllers;

use App\Http\Resources\Project as ProjectResource;
use App\Project;
use App\ProjectsUser;
use App\Task;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** Get Projects */
        $projects_users = ProjectsUser::where(['user_id' => $request->id])->pluck('project_id');

        $projects = Project::where(['user_id' => $request->id])
            ->orWhereIn('id', $projects_users)->
            orderBy('created_at', 'desc')
            ->get();

        /** Return collection of Projects as resource */
        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = $request->isMethod('put') ? Project::findOrFail($request->project_id) : new Project;

        $project->title = $request->input('title');
        $project->body = $request->input('body');
        $project->status = $request->input('status');
        if ($request->isMethod('post')) {
            $project->user_id = $request->input('user_id');
        }
        $project->last_name = $request->input('last_name');
        $project->last_id = $request->input('last_id');

        if ($project->save()) {
            return new ProjectResource($project);
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
        /** Get a Project */
        $project = Project::findOrFail($id);

        /** Return a single project as resource */
        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** Get a Project */
        $project = Project::findOrFail($id);

        if ($project->delete()) {
            return new ProjectResource($project);
        }
    }

    public function export($id)
    {
        if (!empty($id)) {
            $project = Project::findOrFail($id);
            if ($project->status) {
                $stop = "Continues";
            } else {
                $stop = $project->updated_at;
            }
            $tasks = Task::where(['project_id' => $project->id])->get();
            return view('export')->with([
                'start' => $project->created_at,
                'stop' => $stop,
                'title' => $project->title,
                'body' => $project->body,
                'tasks' => $tasks,
            ]);
        }
    }
}