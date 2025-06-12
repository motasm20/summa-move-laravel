<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{
    // Toon alle prestaties van de ingelogde gebruiker
    public function index()
    {
        $performances = Performance::with('exercise')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($performances);
    }

    // Sla een nieuwe prestatie op
    public function store(Request $request)
    {
        $validated = $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'result' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        $performance = Performance::create($validated);

        return response()->json($performance, 201);
    }

    // Update een prestatie
    public function update(Request $request, Performance $performance)
    {
        if ($performance->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validated = $request->validate([
            'result' => 'nullable|string|max:255',
        ]);

        $performance->update($validated);

        return response()->json($performance);
    }

    // Verwijder een prestatie
    public function destroy(Performance $performance)
    {
        if ($performance->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $performance->delete();

        return response()->json(['message' => 'Prestatie verwijderd']);
    }
}
