<?php

namespace App\Http\Controllers;

use App\Models\MarqueeItem;
use Illuminate\Http\Request;

class MarqueeItemController extends Controller
{
    public function index()
    {
        $marqueeItems = MarqueeItem::all();
        return view('marquee_items.index', compact('marqueeItems'));
    }

    public function create()
    {
        return view('marquee_items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'is_active' => 'sometimes|boolean'
        ], [
            'content.required' => 'Content is required.',
        ]);

        MarqueeItem::create($validated);
        return redirect()->route('marquee_items.index')->with('success', 'Marquee item created successfully.');
    }

    public function show(MarqueeItem $marqueeItem)
    {
        return view('marquee_items.show', compact('marqueeItem'));
    }

    public function edit(MarqueeItem $marqueeItem)
    {
        return view('marquee_items.edit', compact('marqueeItem'));
    }

    public function update(Request $request, MarqueeItem $marqueeItem)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'is_active' => 'sometimes|boolean'
        ], [
            'content.required' => 'Content is required.',
        ]);

        $marqueeItem->update($validated);
        return redirect()->route('marquee_items.index')->with('success', 'Marquee item updated successfully.');
    }

    public function destroy(MarqueeItem $marqueeItem)
    {
        $marqueeItem->delete();
        return redirect()->route('marquee_items.index')->with('success', 'Marquee item deleted successfully.');
    }
}
