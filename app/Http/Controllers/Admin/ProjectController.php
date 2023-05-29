<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// Str support module import
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // metodo statico che restituisce tutti i progetti del db
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        // Perform an authorization check
        $this->validation($formData);
        //$formData['budget'] = '$' . number_format($formData['budget'], 2);

        $newProject = new Project();

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('project_images', $request->cover_image);
            $formData['cover_image'] = $path;
        };

        // we use the fill method to fill the model with the data from the request, in the model we must specify the fillable attributes
        $newProject->fill($formData);

        // Assign the slug value based on the 'name' attribute
        $newProject->slug = Str::slug($formData['name']);

        // save must be done before the pivot table insertion, because when we save the row in the db the id gets created
        $newProject->save();

        // insert the technologies relative to the project in the pivot table
        if (array_key_exists('technologies', $formData)) {
            $newProject->technologies()->attach($formData['technologies']);
        }

        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $formData = $request->all();
        $this->validation($formData);

        if ($request->hasFile('cover_image')) {
            // does the image exist in the db? If yes we delete it
            if ($project->cover_image) {
                // delete old image
                Storage::delete($project->cover_image);
            }

            //save new image
            $path = Storage::put('project_images', $request->cover_image);

            $formData['cover_image'] = $path;
        }

        // Assign the slug value based on the 'name' attribute
        $project->slug = Str::slug($formData['name'], '-');

        $project->update($formData);

        // sync the technologies relative to the project in the pivot table
        if (array_key_exists('technologies', $formData)) {
            $project->technologies()->sync($formData['technologies']);
        } else {
            // if the technologies are not selected, we delete the respective rows in the pivot table
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //dd($project);
        // we need to check if our project has an image
        if ($project->cover_image) {
            // delete the image kept in the storage classInstance
            Storage::delete($project->cover_image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
    // custom method
    private function validation($formData)
    {
        $validator = Validator::make($formData, [

            'name' => 'required|max:50',
            'description' => 'required',
            'repository' => 'required|max:255',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',
            'cover_image' => 'nullable|image|max:4096'
        ], [
            // dobbiamo inserire qui un insieme di messaggi da comunicare all'utente per ogni errore che vogliamo modificare
            'name.required' => 'The project name must be inserted',
            'name.max' => 'The project name must be longer than 50 characters',
            'description.required' => "The project description must be inserted",
            'repository.required' => 'The link of the repository must be inserted',
            'repository.max' => 'The link of the repository must be shorter than 255 characters',
            'type_id.exists' => 'The project type must be selected',
            'technologies.exists' => 'The project technology must be selected',
            'cover_image.image' => 'The cover image must be an image file',
            'cover_image.max' => 'The cover image must be shorter than 4096 kilobytes'


        ])->validate();

        // we need to return a value because we are inside a function
        return $validator;
    }
}
