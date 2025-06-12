<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    // Toon alle oefeningen (openbaar)
    public function index()
    {
        return response()->json(Exercise::all());
    }

    // Sla een nieuwe oefening op
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instruction_nl' => 'required|string',
            'instruction_en' => 'required|string',
        ]);

        $exercise = Exercise::create($validated);

        return response()->json($exercise, 201);
    }

    // Update een bestaande oefening
    public function update(Request $request, Exercise $exercise)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'instruction_nl' => 'sometimes|required|string',
            'instruction_en' => 'sometimes|required|string',
        ]);

        $exercise->update($validated);

        return response()->json($exercise);
    }

    // Verwijder een oefening
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return response()->json(['message' => 'Oefening verwijderd']);
    }
}
