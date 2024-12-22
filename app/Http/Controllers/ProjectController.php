<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'image_src' => 'required|image',  // Ensure the uploaded file is an image
            'is_active' => 'boolean'
        ]);

        $imagePath = '';  // Initialize variable to hold the image path

        if ($request->hasFile('image_src')) {
            $imagePath = $request->file('image_src')->store('project_images', 'public');  // Store the image in the 'public' disk under 'project_images'
        }

        // Create the project with the path to the stored image
        Project::create( [
            'image_src' => $imagePath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'type' => $request->type,
            'sort' => $request->sort,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'image_src' => 'sometimes|image',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image_src')) {
            // Delete the old image if it exists
            Storage::disk('public')->delete($project->image_src);

            // Store the new image and update the image path in the data array
            $data['image_src'] = $request->file('image_src')->store('project_images', 'public');
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }


    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
