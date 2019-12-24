<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Requests;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** Get Projects */
        $projects = Project::orderBy('created_at', 'desc')->get();

        /** Return collection of Projects as resource */
        return ProjectResource::collection($projects);
    }

    public function search(Request $request)
    {
        /** Get Projects */
        if (!empty($request->search)) {
            $projects = Project::where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('body', 'LIKE', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')->get();
        } else {
            $projects = Project::orderBy('created_at', 'desc')->get();
        }
        /** Return collection of Projects as resource */
        return ProjectResource::collection($projects);
    }

    public function indexActive()
    {
        /** Get only active Projects */
        $projects = Project::where(['status' => 1])->orderBy('created_at', 'desc')->get();

        /** Return collection of Projects as resource */
        return ProjectResource::collection($projects);
    }

    public function indexEnded()
    {
        /** Get only active Projects */
        $projects = Project::where(['status' => 0])->orderBy('created_at', 'desc')->get();

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
}
