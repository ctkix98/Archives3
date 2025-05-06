<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChaptersController extends Controller
{
    public function index()
    {
        return Chapter::all();
    }

    public function show($id)
    {
        return Chapter::with('choices')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        return Chapter::create($validated);
    }
}
