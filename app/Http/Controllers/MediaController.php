<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    // Display the list of media
    public function index()
    {
        $media = Media::all();
        return view('media.index', compact('media'));
    }

    // Show the form to create new media
    public function create()
    {
        return view('media.create');
    }

    // Store the uploaded media
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:jpg,jpeg,png,mp4,mp3|max:51200', // Max size is 50MB
        ]);


        // Handle File Upload
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        // Determine media type
        $mime = $file->getClientMimeType();
        $type = str_contains($mime, 'image') ? 'image' : (str_contains($mime, 'video') ? 'video' : 'audio');

        // Store in database
        Media::create([
            'title' => $request->title,
            'file_path' => $path,
            'type' => $type,
        ]);

        return redirect()->route('media.index')->with('success', 'Media uploaded successfully.');
    }

    // Show the edit form for a specific media
    public function edit(Media $medium)
    {
        return view('media.edit', compact('medium'));
    }

    // Update the media
    public function update(Request $request, Media $medium)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|mimes:jpg,jpeg,png,mp4,mp3|max:10240',
        ]);

        // Handle file upload if present
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:jpeg,png,jpg,mp4,mov,avi,mp3,wav|max:20480',
            ]);

            // Delete old file
            Storage::disk('public')->delete($medium->file_path);

            // Store new file
            $file = $request->file('file');
            $path = $file->store('uploads', 'public');

            // Determine media type
            $mime = $file->getClientMimeType();
            $type = str_contains($mime, 'image') ? 'image' : (str_contains($mime, 'video') ? 'video' : 'audio');

            // Update file and type
            $medium->update([
                'file_path' => $path,
                'type' => $type,
            ]);
        }

        // Update title
        $medium->update([
            'title' => $request->title,
        ]);

        return redirect()->route('media.index')->with('success', 'Media updated successfully.');
    }

    // Delete the media
    public function destroy(Media $medium)
    {
        // Delete the file from storage
        Storage::delete($medium->file_path);

        // Delete the database record
        $medium->delete();

        return redirect()->route('media.index')->with('success', 'Media deleted successfully.');
    }
}
