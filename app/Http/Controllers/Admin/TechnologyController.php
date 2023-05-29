<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Requests\Request;
// use App\Http\Requests\Request;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Str support module import
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Type;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // metodo statico che restituisce tutti i progetti del db
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // here we get all the technologies and then we pass them to the view
        $technologies = Technology::all();
        return view('admin.technologies.create', compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // we validate the request by
        $formData = $request->all();

        $formData['slug'] = Str::slug($formData['name'], '-');
        $newTechnology = new Technology();

        $newTechnology->fill($formData);

        $newTechnology->save();
        $this->validation($formData);
        return redirect()->route('admin.technologies.show', $newTechnology)->with('success', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $formData = $request->all();

        $this->validation($formData);

        $formData['slug'] = Str::slug($formData['name'], '-');


        $technology->update($formData);

        return redirect()->route('admin.technologies.show', $technology)->with('success', 'Technology updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Technology deleted successfully');
    }
    // custom methods
    private function validation($formData)
    {
        $validator = Validator::make($formData, [

            'name' => 'max:100|required|unique:App\Models\Type,name',

        ], [
            // dobbiamo inserire qui un insieme di messaggi da comunicare all'utente per ogni errore che vogliamo modificare
            'name.max' => 'The name must not exceed 100 characters',
            'name.required' => 'The name is required',
            'name.unique' => 'This type is already in use',

        ])->validate();

        // we need to return a value because we are inside a function
        return $validator;
    }
}
