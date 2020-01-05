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
    public function index(Request $request)
    {
        /** Get Projects */
        $projects = Project::where(['user_id' => $request->id])->orderBy('created_at', 'desc')->get();

        /** Return collection of Projects as resource */
        return ProjectResource::collection($projects);
    }

    public function search(Request $request)
    {
        /** Get Projects */
        $projects = Project::where(['user_id' => $request->id]);
        if (!empty($request->search)) {
            $projects = $projects->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('body', 'LIKE', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')->get();
        } else {
            $projects = $projects->orderBy('created_at', 'desc')->get();
        }
        /** Return collection of Projects as resource */
        return ProjectResource::collection($projects);
    }

    public function indexActive(Request $request)
    {
        /** Get only active Projects */
        $projects = Project::where(['status' => 1, 'user_id' => $request->id])->orderBy('created_at', 'desc')->get();

        /** Return collection of Projects as resource */
        return ProjectResource::collection($projects);
    }

    public function indexEnded(Request $request)
    {
        /** Get only ended Projects */
        $projects = Project::where(['status' => 0, 'user_id' => $request->id])->orderBy('created_at', 'desc')->get();

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
        return view('export');
    }
}