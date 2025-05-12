<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;

class ChoicesController extends Controller
{
    // Retourne toutes les options de tous les chapitres
    public function index()
    {
        return Choice::all();
    }

    // Valide les données reçues puis crée une nouvelle option (lien entre deux chapitres)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'chapter_id' => 'required|exists:chapters,id',
            'text' => 'required|string',
            'target_chapter_id' => 'required|exists:chapters,id',
        ]);

        return Choice::create($validated);
    }
}
