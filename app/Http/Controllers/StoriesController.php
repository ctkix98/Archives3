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

    // Retourne une histoire avec ses chapitres et les choix associés à chaque chapitre
    public function show($id)
    {
        return Story::with('chapters.choices')->findOrFail($id);
    }

    // Valide les données reçues puis crée une nouvelle histoire
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return Story::create($validated);
    }
}
