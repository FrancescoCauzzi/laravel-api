<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Str support module import
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.types.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();

        $this->validation($formData);

        $formData['slug'] = Str::slug($formData['name'], '-');
        $newType = new Type();

        $newType->fill($formData);

        $newType->save();

        return redirect()->route('admin.types.show', $newType)->with('success', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {

        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $formData = $request->all();

        $this->validation($formData);

        $formData['slug'] = Str::slug($formData['name'], '-');


        $type->update($formData);

        return redirect()->route('admin.types.show', $type)->with('success', 'Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Type deleted successfully');
    }
    // custom methods
    private function validation($formData)
    {
        $validator = Validator::make($formData, [

            'name' => 'max:100|required|unique:App\Models\Type,name',
            'description' => 'required',

        ], [
            // dobbiamo inserire qui un insieme di messaggi da comunicare all'utente per ogni errore che vogliamo modificare
            'name.max' => 'The name must not exceed 100 characters',
            'name.required' => 'The name is required',
            'name.unique' => 'This type is already in use',
            'description.required' => 'The description is required',
        ])->validate();

        // we need to return a value because we are inside a function
        return $validator;
    }
}
