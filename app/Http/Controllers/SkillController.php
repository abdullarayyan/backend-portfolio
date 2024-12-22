<?php
namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\SkillsSection;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::with('section')->get();
        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        $sections = SkillsSection::all();
        return view('skills.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'boolean',
            'skills_section_id' => 'nullable|exists:skills_sections,id',
        ]);

        Skill::create($request->all());

        return redirect()->route('skills.index')->with('success', 'Skill added successfully.');
    }

    public function edit(Skill $skill)
    {
        $sections = SkillsSection::all();
        return view('skills.edit', compact('skill', 'sections'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'boolean',
            'skills_section_id' => 'nullable|exists:skills_sections,id',
        ]);

        $skill->update($request->all());

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }
}
