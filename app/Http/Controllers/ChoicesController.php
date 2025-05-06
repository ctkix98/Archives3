<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;

class ChoicesController extends Controller
{
    public function index()
    {
        return Choice::all();
    }

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
