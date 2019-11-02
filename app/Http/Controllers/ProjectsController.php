<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Resources\Project as ProjectResorce;
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
        $projects = Project::paginate(15);

        /** Return collection of Projects as resource */
        return ProjectResorce::collection($projects);
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

        $project->id = $request->input('project_id');
        $project->title = $request->input('title');
        $project->body = $request->input('body');

        if ($project->save()){
            return new ProjectResorce($project);
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
        return new ProjectResorce($project);
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

        if ($project->delete()){
            return new ProjectResorce($project);
        }
    }
}