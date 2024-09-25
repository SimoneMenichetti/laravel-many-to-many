<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Genera i progetti da config
        $projects = config('projects');

        foreach ($projects as $projectData) {
            $project = Project::create([
                'name' => $projectData['name'],
                'description' => $projectData['description'],
                'slug' => Helper::generateSlug($projectData['name'], Project::class),
                'type_id' => Type::all()->random()->id,
            ]);

            // Associa tecnologie casuali al progetto
            $technologyIds = Technology::all()->random(rand(1, 3))->pluck('id');
            $project->technologies()->attach($technologyIds);
        }

        // Genera 100 progetti casuali aggiuntivi
        for ($i = 1; $i <= 100; $i++) {
            $project = Project::create([
                'name' => 'Project ' . $i,
                'description' => 'Description for Project ' . $i,
                'slug' => Helper::generateSlug('Project ' . $i, Project::class),
                'type_id' => Type::all()->random()->id,
            ]);

            // Associa tecnologie casuali al progetto
            $technologyIds = Technology::all()->random(rand(1, 3))->pluck('id');
            $project->technologies()->attach($technologyIds);
        }
    }
}
