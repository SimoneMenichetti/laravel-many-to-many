<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Restituisce la lista dei progetti in formato JSON con un messaggio di successo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $projects = Project::paginate(20);

        $successes = true;
        $response = [
            'successes' => $successes,
            'results' => $projects
        ];

        return response()->json($response);
    }


    public function projectBySlug($slug)
    {
        $project = Project::where('slug', $slug)->first();
        dump($project);
    }
}
