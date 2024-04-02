<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'thumb' => ['nullable'],
            'date' => ['required']
        ]);


        $formData = $request->all();

        $slug = Project::generateSlug($request->title);
        $formData['slug'] = $slug;

        if ($request->hasFile('thumb')) {
            $image = $request->file('thumb');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images', $imageName);
        }

        // $request->image->storeAs('images', $imageName);




        $newProject = new Project();
        $newProject->fill($formData);
        $newProject->thumb = $imageName;


        $newProject->save();


        return redirect()->route('home');


    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view("layouts.single",compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view("layouts.edit",compact("project"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'thumb' => ['nullable'],
            'date' => ['required']
        ]);



        $formData = $request->all();
        $project = project::find($id);

        if ($request->hasFile('thumb')) {
            if( $project->thumb ){
                Storage::delete('public/images/' . $project->thumb);
            }


            $image = $request->file('thumb');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images', $imageName);
        }


        $formData['thumb']=$imageName;

        $project->update($formData);

        return redirect()->route("home",compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $project = project::find($id);
        if( $project->thumb ){
            Storage::delete('public/images/' . $project->thumb);
        }
        $project->delete();
        return redirect()->route('home');
    }
}
