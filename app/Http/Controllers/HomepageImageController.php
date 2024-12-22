<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Models\HomepageImage;
use Illuminate\Http\Request;

class HomepageImageController extends Controller
{
    public function index()
    {
        $images = HomepageImage::all();
        $homepages = Homepage::all();
        return view('homepage_images.index', compact('images','homepages'));
    }

    public function create()
    {
        $homepages = Homepage::all();
        return view('homepage_images.create',compact('homepages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'homepage_id' => 'required|integer|exists:homepages,id',
            'type' => 'required|in:profile,click,angle',
            'path' => 'image|required|max:2048', // Ensuring the uploaded file is an image
            'is_active' => 'sometimes|boolean'
        ]);

        $imagePath = $request->file('path')->store('homepage_images', 'public');

        HomepageImage::create([
            'homepage_id' => $request->homepage_id,
            'type' => $request->type,
            'path' => $imagePath,
            'sort' => $request->sort,
            'is_active' => $request->has('is_active') ? $request->is_active : false
        ]);

        return redirect()->route('homepage_images.index');
    }

    public function show(HomepageImage $homepageImage)
    {
        return view('homepage_images.show', compact('homepageImage'));
    }

    public function edit(HomepageImage $homepageImage)
    {
        $homepages = Homepage::all();
        return view('homepage_images.edit', compact('homepageImage','homepages'));
    }

    public function update(Request $request, HomepageImage $homepageImage)
    {
        $request->validate([
            'homepage_id' => 'required|integer|exists:homepages,id',
            'type' => 'required|in:profile,click,angle',
            'path' => 'sometimes|image|max:2048',
            'is_active' => 'sometimes|boolean'
        ]);

        if ($request->hasFile('path')) {
            $imagePath = $request->file('path')->store('homepage_images', 'public');
            $homepageImage->path = $imagePath;
        }

        $homepageImage->update($request->except(['path']) + ['path' => $homepageImage->path]);

        return redirect()->route('homepage_images.index');
    }

    public function destroy(HomepageImage $homepageImage)
    {
        $homepageImage->delete();
        return redirect()->route('homepage_images.index');
    }
}
