<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectSection;
use Illuminate\Http\Request;

class ProjectSectionController extends Controller
{
    public function index()
    {
        $sections = ProjectSection::with('project')->get();
        return view('project_sections.index', compact('sections'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('project_sections.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'type' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'has_images' => 'boolean',
            'has_grid_images' => 'boolean',
            'is_active' => 'boolean'
        ]);

        ProjectSection::create($request->all());
        return redirect()->route('project_sections.index')->with('success', 'Section created successfully.');
    }

    public function show(ProjectSection $projectSection)
    {
        return view('project_sections.show', compact('projectSection'));
    }

    public function edit(ProjectSection $projectSection)
    {
        $projects = Project::all();
        return view('project_sections.edit', compact('projectSection', 'projects'));
    }

    public function update(Request $request, ProjectSection $projectSection)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'type' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'has_images' => 'boolean',
            'has_grid_images' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $projectSection->update($request->all());
        return redirect()->route('project_sections.index')->with('success', 'Section updated successfully.');
    }

    public function destroy(ProjectSection $projectSection)
    {
        $projectSection->delete();
        return redirect()->route('project_sections.index')->with('success', 'Section deleted successfully.');
    }
    public function images(ProjectSection $section)
    {
        $images = $section->images;
        return view('project_sections.images', compact('section', 'images'));
    }
}
