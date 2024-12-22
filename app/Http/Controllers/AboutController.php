<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('about.index', compact('abouts'));
    }

    public function create()
    {
        return view('about.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'name_1' => 'required|string|max:255',
            'name_2' => 'required|string|max:255',
            'description' => 'required|string',
            'is_active' => 'sometimes|boolean'
        ], [
            'title.required' => 'The title field is mandatory.',
            'name_1.required' => 'The first name field is mandatory.',
            'name_2.required' => 'The second name field is mandatory.',
            'description.required' => 'The description is required.'
        ]);

        Log::info('Storing new about information:', $validated);

        About::create($validated);
        return redirect()->route('about.index')->with('success', 'About section created successfully.');
    }

    public function show(About $about)
    {
        return view('about.show', compact('about'));
    }

    public function edit(About $about)
    {
        return view('about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'name_1' => 'required|string|max:255',
            'name_2' => 'required|string|max:255',
            'description' => 'required|string',
            'is_active' => 'sometimes|boolean'
        ], [
            'title.required' => 'The title field is mandatory.',
            'name_1.required' => 'The first name field is mandatory.',
            'name_2.required' => 'The second name field is mandatory.',
            'description.required' => 'The description is required.'
        ]);

        Log::info('Updating about information for ID: ' . $about->id, $validated);

        $about->update($validated);
        return redirect()->route('about.index')->with('success', 'About section updated successfully.');
    }

    public function destroy(About $about)
    {
        Log::info('Deleting about section with ID: ' . $about->id);
        $about->delete();
        return redirect()->route('about.index')->with('success', 'About section deleted successfully.');
    }
}
