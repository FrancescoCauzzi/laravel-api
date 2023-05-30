<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // return all the Projects in the database
        // $projects = Project::all();

        // here we are using the with method to eager load the type of the project  and the technologies of the project
        // and then we are ordering them by the date of creation of the project
        $projects = Project::with('type', 'technologies')
            ->orderBy('projects.created_at', 'desc')
            ->paginate(2);


        return response()->json([
            'success' => true,
            'results' => $projects,
        ]);
    }
}
