<?php
namespace App\Http\Controllers;

use App\Models\SkillsSection;
use Illuminate\Http\Request;

class SkillsSectionController extends Controller
{
    public function index()
    {
        $sections = SkillsSection::all();
        return view('skills_sections.index', compact('sections'));
    }

    public function create()
    {
        return view('skills_sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        SkillsSection::create($request->all());

        return redirect()->route('skills_sections.index')->with('success', 'Skills Section created successfully.');
    }

    public function edit(SkillsSection $skillsSection)
    {
        return view('skills_sections.edit', compact('skillsSection'));
    }

    public function update(Request $request, SkillsSection $skillsSection)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $skillsSection->update($request->all());

        return redirect()->route('skills_sections.index')->with('success', 'Skills Section updated successfully.');
    }

    public function destroy(SkillsSection $skillsSection)
    {
        $skillsSection->delete();

        return redirect()->route('skills_sections.index')->with('success', 'Skills Section deleted successfully.');
    }
}
