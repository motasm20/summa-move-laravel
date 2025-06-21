<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Toon lijst met oefeningen
    public function index()
    {
        $exercises = Exercise::all();
        return view('admin.exercises.index', compact('exercises'));
    }

    // Formulier voor nieuwe oefening
    public function create()
    {
        return view('admin.exercises.create');
    }

    // Opslaan van nieuwe oefening
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instruction_nl' => 'required|string',
            'instruction_en' => 'required|string',
        ]);

        Exercise::create($validated);

        return redirect()->route('admin.exercises.index')->with('success', 'Oefening aangemaakt');
    }

    // Toon een oefening (optioneel)
    public function show(Exercise $exercise)
    {
        return view('admin.exercises.show', compact('exercise'));
    }

    // Formulier voor bewerken
    public function edit(Exercise $exercise)
    {
        return view('admin.exercises.edit', compact('exercise'));
    }

    // Bewaar bewerking
    public function update(Request $request, Exercise $exercise)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instruction_nl' => 'required|string',
            'instruction_en' => 'required|string',
        ]);

        $exercise->update($validated);

        return redirect()->route('admin.exercises.index')->with('success', 'Oefening bijgewerkt');
    }

    // Verwijder oefening
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return redirect()->route('admin.exercises.index')->with('success', 'Oefening verwijderd');
    }
}

