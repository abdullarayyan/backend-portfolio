<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;

class HomepageController extends Controller
{
    public function index()
    {
        $homepages = Homepage::all();
        return view('homepages.index', compact('homepages'));
    }

    public function create()
    {
        return view('homepages.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_line_1' => 'required|string|max:255',
            'role_line_2' => 'required|string|max:255',
            'flip_role'   => 'required|string|max:255',
            'is_active'   => 'sometimes|boolean'
        ]);

        Homepage::create($validatedData);
        return redirect()->route('homepages.index');
    }

    public function show(Homepage $homepage)
    {
        return view('homepages.show', compact('homepage'));
    }

    public function edit(Homepage $homepage)
    {
        return view('homepages.edit', compact('homepage'));
    }

    public function update(Request $request, Homepage $homepage)
    {
        $validatedData = $request->validate([
            'role_line_1' => 'required|string|max:255',
            'role_line_2' => 'required|string|max:255',
            'flip_role'   => 'required|string|max:255',
            'is_active'   => 'sometimes|boolean'
        ]);

        $homepage->update($validatedData);
        return redirect()->route('homepages.index');
    }

    public function destroy(Homepage $homepage)
    {
        $homepage->delete();
        return redirect()->route('homepages.index');
    }
}
