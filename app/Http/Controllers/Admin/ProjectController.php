<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Functions\Helper;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Laravel\Prompts\Progress;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('type')->orderBy('id', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ottengo tutti i type
        $types = Type::all();
        // ottengo tutte le technology
        $technologies = Technology::all();
        return view('Admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Helper::generateSlug($validatedData['name'], Project::class);

        // Crea il progetto usando i dati validati, incluso lo slug
        $project = Project::create($validatedData);

        // associo le tech selezionate

        if (!empty($request->technologies)) {
            $project->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('type');
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // ottengo tutti i type
        $types = Type::all();
        // ottengo tutte le technology
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $validatedData = $request->validated();
        $validatedData['slug'] = Helper::generateSlug($validatedData['name'], Project::class);

        $project->update($validatedData);

        if (!empty($request->technologies)) {

            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.index')->with('success', 'Progetto modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo!');
    }
}
