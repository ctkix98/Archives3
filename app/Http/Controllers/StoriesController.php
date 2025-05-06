<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    public function index()
    {
        return Story::all();
    }

    public function show($id)
    {
        return Story::with('chapters.choices')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return Story::create($validated);
    }
}
