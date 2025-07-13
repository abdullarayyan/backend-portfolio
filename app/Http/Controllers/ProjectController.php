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
            'is_active' => 'boolean',
            'skill_id' => 'required|exists:skills,id' // Ensure the skill exists
        ]);

        $imagePath = '';  // Initialize variable to hold the image path

        if ($request->hasFile('image_src')) {
            $imagePath = $request->file('image_src')->store('project_images', 'public');  // Store the image in the 'public' disk under 'project_images'
        }

        if ($request->hasFile('image_mobile')) {
            $mobileImagePath = $request->file('image_mobile')->store('project_images', 'public');
        } else {
            $mobileImagePath = null;
        }

        // Create the project with the path to the stored image
        Project::create( [
            'image_src' => $imagePath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'type' => $request->type,
            'sort' => $request->sort,
            'is_active' => $request->is_active,
            'skill_id' => $request->skill_id, // Storing skill_id
            'image_mobile' => $mobileImagePath,
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
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
            'image_src' => 'sometimes|image',
            'is_active' => 'sometimes|boolean',
            'skill_id' => 'sometimes|exists:skills,id',
            'subscribers' => 'sometimes|nullable|integer|min:0',
            'satisfaction_rate' => 'sometimes|nullable|integer|min:0|max:100',
        ]);

        // إذا في صورة جديدة
        if ($request->hasFile('image_src')) {
            Storage::disk('public')->delete($project->image_src);
            $validated['image_src'] = $request->file('image_src')->store('project_images', 'public');
        }

        if ($request->hasFile('image_mobile')) {
            if ($project->image_mobile) {
                Storage::disk('public')->delete($project->image_mobile);
            }
            $validated['image_mobile'] = $request->file('image_mobile')->store('project_images', 'public');
        }

        $project->update($validated);

        return redirect()->back()->with('success', 'تم تحديث المشروع بنجاح');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
