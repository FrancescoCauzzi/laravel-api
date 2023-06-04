<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // return all the Projects in the database
        // $projects = Project::all();

        $requestData = $request->all();

        $types = Type::all();

        // I check if there is a parameter type_id in the request and that is not null
        if ($request->has('type_id') && $requestData['type_id']) {
            $projects = Project::where('type_id', $requestData['type_id'])
                ->with('type', 'technologies')
                ->orderBy('projects.created_at', 'desc')
                ->paginate(2);

            if (count($projects) == 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'No projects found',

                ]);
            };
        } else {
            // here we are using the with method to eager load the type of the project  and the technologies of the project
            // and then we are ordering them by the date of creation of the project
            $projects = Project::with('type', 'technologies')
                ->orderBy('projects.created_at', 'desc')
                ->paginate(2);
        };

        return response()->json([
            'success' => true,
            'results' => $projects,
            'allTypes' => $types,
        ]);
    }
    public function show($slug)
    {
        // we are using the where method to find the project with the slug parameter in the database
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        // the same as doing:
        // 'SELECT * FROM projects WHERE slug = $slug'

        if ($project) {
            // we return the project in json format with the success message
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } else {
            // if the project is not found we return an error message in json format with the success message set to false
            return response()->json([
                'success' => false,
                'error' => 'The project does not exist',
            ]);
        }
    }
}
