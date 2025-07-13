<?php
namespace App\Http\Controllers;

use App\Models\ProjectSection;
use App\Models\SectionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionImageController extends Controller
{
    public function index()
    {
        $images = SectionImage::with('section')->get();
        return view('section_images.index', compact('images'));
    }

    public function create(Request $request)
    {
        $sections = ProjectSection::all();
        $sectionId = $request->get('section_id'); // للانتقال من قسم معيّن
        return view('section_images.create', compact('sections', 'sectionId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:project_sections,id',
            'type' => 'required|in:regular,grid',
            'path' => 'required|image',
            'is_active' => 'boolean'
        ]);

        $imagePath = $request->file('path')->store('section_images', 'public');

        SectionImage::create( [
            'path' => $imagePath,
            'section_id' => $request->section_id,
            'type' => $request->type,
            'is_active' => $request->is_active,
//            'section_id' => $request->section_id,

        ]);

        return redirect()->route('section_images.index')->with('success', 'Image added successfully.');
    }

    public function show(SectionImage $sectionImage)
    {
        return view('section_images.show', compact('sectionImage'));
    }

    public function edit(SectionImage $sectionImage)
    {
        $sections = ProjectSection::all();
        return view('section_images.edit', compact('sectionImage', 'sections'));
    }

    public function update(Request $request, SectionImage $sectionImage)
    {
        $request->validate([
            'section_id' => 'required|exists:project_sections,id',
            'type' => 'required|in:regular,grid',
            'path' => 'sometimes|image',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('path')) {
            Storage::disk('public')->delete($sectionImage->path);
            $path = $request->file('path')->store('section_images', 'public');
            $sectionImage->update($request->all() + ['path' => $path]);
        } else {
            $sectionImage->update($request->all());
        }

        return redirect()->route('section_images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(SectionImage $sectionImage)
    {
        Storage::disk('public')->delete($sectionImage->path);
        $sectionImage->delete();
        return redirect()->route('section_images.index')->with('success', 'Image deleted successfully.');
    }
}
