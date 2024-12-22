<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $heroSections = HeroSection::all();
//        dd('ff');
        return view('hero_sections.index', compact('heroSections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('hero_sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_line1' => 'required|string|max:255',
            'role_line2' => 'nullable|string|max:255',
            'flip_role' => 'nullable|string|max:255',
            'profile_image' => 'nullable|string',
            'click_image' => 'nullable|string',
            'angles_images' => 'nullable|array'
        ]);

        $heroSection = HeroSection::create($validated);
        return redirect()->route('hero-sections.index')->with('success', 'Hero section created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HeroSection  $heroSection
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(HeroSection $heroSection)
    {
        return view('hero_sections.show', compact('heroSection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeroSection  $heroSection
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(HeroSection $heroSection)
    {
        return view('hero_sections.edit', compact('heroSection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HeroSection  $heroSection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'role_line1' => 'required|string|max:255',
            'role_line2' => 'nullable|string|max:255',
            'flip_role' => 'nullable|string|max:255',
            'profile_image' => 'nullable|string',
            'click_image' => 'nullable|string',
            'angles_images' => 'nullable|array'
        ]);

        $heroSection->update($validated);
        return redirect()->route('hero-sections.index')->with('success', 'Hero section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeroSection  $heroSection
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(HeroSection $heroSection)
    {
        $heroSection->delete();
        return redirect()->route('hero-sections.index')->with('success', 'Hero section deleted successfully.');
    }
}
