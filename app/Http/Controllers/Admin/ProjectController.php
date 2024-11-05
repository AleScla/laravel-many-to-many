<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Technology;

use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'title'=>'required|min:3|max:64',
            'description'=>'required|min:3|max:1024',
            'cover'=>'nullable|image|max:2048',
            'completed'=>'required|integer|min:0|max:1',
            'starting_date'=> 'nullable|date',
            'level'=>'nullable|min:3|max:64',
            'type_id'=>'nullable|exists:types,id',
            'technologies'=>'nullable|array|exists:technologies,id',
        ]);



        $imgPath = Storage::put('uploads', $data['cover']);
        $data['cover'] = $imgPath;

        $project = Project::Create($data);

        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();

        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $data = $request->validate([
            'title'=>'required|min:3|max:64',
            'description'=>'required|min:3|max:1024',
            'cover'=>'nullable|image|max:2048',
            'completed'=>'required|integer|min:0|max:1',
            'starting_date'=> 'nullable|date',
            'level'=>'nullable|min:3|max:64',
            'type_id'=>'nullable|exists:types,id',
            'technologies'=>'nullable|array|exists:technologies,id',
            'coverRemover' => 'nullable'
        ]);
        

        if(isset($data['cover'])){
            if($project->cover){
                Storage::delete($project->cover);
                $project->cover = null;
            }
            $imgPath = Storage::put('uploads', $data['cover']);
            $data['cover'] = $imgPath;
        }
        else if(isset($data['coverRemover'])&& $project->cover){
            Storage::delete($project->cover);
            $project->cover = null;
        }

        $project->update($data);
        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
